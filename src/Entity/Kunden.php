<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kunden
 *
 * @ORM\Table(name="kunden")
 * @ORM\Entity(repositoryClass="App\Repository\KundenRepository")
 */
class Kunden
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="nachname", type="string", length=80, nullable=false)
     */
    private $nachname;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_name", type="string", length=80, nullable=false)
     */
    private $firmaName;

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

    public function getNachname(): ?string
    {
        return $this->nachname;
    }

    public function setNachname(string $nachname): self
    {
        $this->nachname = $nachname;

        return $this;
    }

    public function getFirmaName(): ?string
    {
        return $this->firmaName;
    }

    public function setFirmaName(string $firmaName): self
    {
        $this->firmaName = $firmaName;

        return $this;
    }


}
