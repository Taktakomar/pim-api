<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Artikel
 *
 * @ORM\Table(name="artikel", indexes={@ORM\Index(name="kollektion_id", columns={"kollektion_id"}), @ORM\Index(name="kategorie_id", columns={"kategorie_id"}), @ORM\Index(name="image_id", columns={"image_id"}), @ORM\Index(name="farbe_id", columns={"farbe_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArikelRepository")
 */
class Artikel
{
    /**
     * @var int
     *
     * @ORM\Column(name="artikel_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    
    private $artikelId;

    /**
     * @var string
     *
     * @ORM\Column(name="artikel_name", type="string", length=40, nullable=false)
     */
    private $artikelName;

    /**
     * @var float
     *
     * @ORM\Column(name="preis", type="float", precision=10, scale=0, nullable=false)
     */
    private $preis;

    /**
     * @var \Kategorie
     *
     * @ORM\ManyToOne(targetEntity="Kategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kategorie_id", referencedColumnName="kategorie_id")
     * })
     */
    private $kategorie;

  /**
     * @var \Images
     *
     * @ORM\ManyToOne(targetEntity="Images")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_id", referencedColumnName="image_id")
     * })
     */
    private $bild;

    /**
     * @var \Farbe
     *
     * @ORM\ManyToOne(targetEntity="Farbe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="farbe_id", referencedColumnName="farbe_id")
     * })
     */
    private $farbe;

    /**
     * @var \Kollektion
     *
     * @ORM\ManyToOne(targetEntity="Kollektion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kollektion_id", referencedColumnName="kollektion_id")
     * })
     */
    private $kollektion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $menge;

    public function getArtikelId(): ?int
    {
        return $this->artikelId;
    }

    public function getArtikelName(): ?string
    {
        return $this->artikelName;
    }

    public function setArtikelName(string $artikelName): self
    {
        $this->artikelName = $artikelName;

        return $this;
    }

    public function getPreis(): ?float
    {
        return $this->preis;
    }

    public function setPreis(float $preis): self
    {
        $this->preis = $preis;

        return $this;
    }

    public function getKategorie():?Kategorie
    {
        return $this->kategorie;
    }

    public function setKategorie(?Kategorie $kategorie): self
    {
        $this->kategorie = $kategorie;

        return $this;
    }

    public function getBild(): ?Images
    {
        return $this->bild;
    }

    public function setBild(?Images $bild): self
    {
        $this->bild = $bild;

        return $this;
    }

    public function getFarbe(): ?Farbe
    {
        return $this->farbe;
    }

    public function setFarbe(?Farbe $farbe): self
    {
        $this->farbe = $farbe;

        return $this;
    }
    

    public function getKollektion(): ?Kollektion
    {
        return $this->kollektion;
    }

    public function setKollektion(?Kollektion $kollektion): self
    {
        $this->kollektion = $kollektion;

        return $this;
    }

    public function getMenge(): ?string
    {
        return $this->menge;
    }

    public function setMenge(string $menge): self
    {
        $this->menge = $menge;

        return $this;
    }


}
