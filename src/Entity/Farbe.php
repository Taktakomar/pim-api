<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Farbe
 *
 * @ORM\Table(name="farbe")
 * @ORM\Entity(repositoryClass="App\Repository\FarbeRepository")
 */
class Farbe
{
    /**
     * @var int
     *
     * @ORM\Column(name="farbe_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $farbeId;

    /**
     * @var string
     *
     * @ORM\Column(name="farbe_name", type="string", length=40, nullable=false)
     */
    private $farbeName;

    /**
     * @var string
     *
     * @ORM\Column(name="farbe_beschreibung", type="string", length=40, nullable=false)
     */
    private $farbeBeschreibung;

    public function getFarbeId(): ?int
    {
        return $this->farbeId;
    }

    public function getFarbeName(): ?string
    {
        return $this->farbeName;
    }

    public function setFarbeName(string $farbeName): self
    {
        $this->farbeName = $farbeName;

        return $this;
    }

    public function getFarbeBeschreibung(): ?string
    {
        return $this->farbeBeschreibung;
    }

    public function setFarbeBeschreibung(string $farbeBeschreibung): self
    {
        $this->farbeBeschreibung = $farbeBeschreibung;

        return $this;
    }


}
