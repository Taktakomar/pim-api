<?php

namespace App\Entity;

use App\Repository\FileTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="file_type")
 * @ORM\Entity(repositoryClass=FileTypeRepository::class)
 */
class FileType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,nullable=false)
     */
    private $name;

    public function __construct()
    {
        $this->flows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
   
}
