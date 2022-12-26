<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221226163938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artikel CHANGE farbe_id farbe_id INT DEFAULT NULL, CHANGE kollektion_id kollektion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artikel_defintionen CHANGE artikel_id artikel_id INT DEFAULT NULL, CHANGE definition_id definition_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artikel CHANGE farbe_id farbe_id INT NOT NULL, CHANGE kollektion_id kollektion_id INT NOT NULL');
        $this->addSql('ALTER TABLE artikel_defintionen CHANGE artikel_id artikel_id INT NOT NULL, CHANGE definition_id definition_id INT NOT NULL');
    }
}
