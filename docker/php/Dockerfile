FROM php:7.4-fpm



WORKDIR /var/www/html

# install git
RUN apt-get update && \
    apt-get install -y --no-install-recommends git

RUN usermod -u 1000 www-data

#install some base extensions
RUN apt-get update && \
    apt-get install -y \
        build-essential \
        libssl-dev \
        zlib1g-dev \
        libzip-dev \
        libwebp-dev \
        zip \
        unzip \
        libpng-dev \
        libjpeg-dev \
        exiftool \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libicu-dev \
        libpq-dev \
        libxpm-dev \
        libvpx-dev \
        mariadb-client \
        libxml2-dev \
        wget \


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=1.10.16 --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Configure GD
RUN docker-php-ext-configure gd \
    --with-freetype --with-webp --with-jpeg \
   && docker-php-ext-install gd

RUN docker-php-ext-install -j$(nproc) \
   exif \
   bcmath \
   intl \
   pcntl \
   mysqli \
   pdo \
   pdo_mysql \
   pdo_pgsql \
   soap \
   opcache

# install xdebug
# RUN pecl install xdebug \
#     && docker-php-ext-enable xdebug \
#     && echo "zend_extension=$(find /usr/local/lib/php/ -name xdebug.so)" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.profiler_enable=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.remote_port=9999" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_10.x > setup_10.x \
    && chmod +x setup_10.x \
    && ./setup_10.x \
    && apt install -y nodejs

###
### Install yarn package manager for webpack-encore
###
RUN npm install -g yarn

EXPOSE 9000

CMD ["php-fpm"]