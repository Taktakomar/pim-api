<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kategorie
 * @ORM\Table(name="kategorie")
 * @ORM\Entity(repositoryClass="App\Repository\KategorieRepository")
 */
class Kategorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="kategorie_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $kategorieId;

    /**
     * @var string
     *
     * @ORM\Column(name="kategorie_name", type="string", length=40, nullable=false)
     */
    private $kategorieName;

    /**
     * @var string
     *
     * @ORM\Column(name="kategorie_beschreibung", type="string", length=40, nullable=false)
     */
    private $kategorieBeschreibung;

    public function getKategorieId(): ?int
    {
        return $this->kategorieId;
    }

    public function getKategorieName(): ?string
    {
        return $this->kategorieName;
    }

    public function setKategorieName(string $kategorieName): self
    {
        $this->kategorieName = $kategorieName;

        return $this;
    }

    public function getKategorieBeschreibung(): ?string
    {
        return $this->kategorieBeschreibung;
    }

    public function setKategorieBeschreibung(string $kategorieBeschreibung): self
    {
        $this->kategorieBeschreibung = $kategorieBeschreibung;

        return $this;
    }


}
