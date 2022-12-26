<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kollektion
 *
 * @ORM\Table(name="kollektion")
 * @ORM\Entity(repositoryClass="App\Repository\KollektionRepository")
 */
class Kollektion
{
    /**
     * @var int
     *
     * @ORM\Column(name="kollektion_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $kollektionId;

    /**
     * @var string
     *
     * @ORM\Column(name="kollektion_name", type="string", length=40, nullable=false)
     */
    private $kollektionName;

    /**
     * @var string
     *
     * @ORM\Column(name="kollektion_beschreibung", type="string", length=40, nullable=false)
     */
    private $kollektionBeschreibung;

    public function getKollektionId(): ?int
    {
        return $this->kollektionId;
    }

    public function getKollektionName(): ?string
    {
        return $this->kollektionName;
    }

    public function setKollektionName(string $kollektionName): self
    {
        $this->kollektionName = $kollektionName;

        return $this;
    }

    public function getKollektionBeschreibung(): ?string
    {
        return $this->kollektionBeschreibung;
    }

    public function setKollektionBeschreibung(string $kollektionBeschreibung): self
    {
        $this->kollektionBeschreibung = $kollektionBeschreibung;

        return $this;
    }


}
