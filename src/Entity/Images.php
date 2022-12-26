<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
 */
class Images
{
    /**
     * @var int
     *
     * @ORM\Column(name="image_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $imageId;

    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=40, nullable=false)
     */
    private $imageName;

    /**
     * @var string
     *
     * @ORM\Column(name="image_path", type="string", length=40, nullable=false)
     */
    private $imagePath;

    public function getImageId(): ?int
    {
        return $this->imageId;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }


}
