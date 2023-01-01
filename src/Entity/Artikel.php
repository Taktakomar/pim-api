<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artikel
 *
 * @ORM\Table(name="artikel", indexes={@ORM\Index(name="image_id", columns={"image_id"}), @ORM\Index(name="farbe_id", columns={"farbe_id"}), @ORM\Index(name="kollektion_id", columns={"kollektion_id"}), @ORM\Index(name="kategorie_id", columns={"kategorie_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArtikelRepository")
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
     * @var string
     *
     * @ORM\Column(name="menge", type="string", length=255, nullable=false)
     */
    private $menge;

    /**
     * @var string
     *
     * @ORM\Column(name="Nav_id", type="string", length=80, nullable=false)
     */
    private $navId;

    /**
     * @var \Images
     *
     * @ORM\ManyToOne(targetEntity="Images" ,fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_id", referencedColumnName="image_id")
     * })
     */
    private $image;

    /**
     * @var \Kollektion
     *
     * @ORM\ManyToOne(targetEntity="Kollektion",fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kollektion_id", referencedColumnName="kollektion_id")
     * })
     */
    private $kollektion;

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
     * @var \Kategorie
     *
     * @ORM\ManyToOne(targetEntity="Kategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kategorie_id", referencedColumnName="kategorie_id")
     * })
     */
    private $kategorie;

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

    public function getMenge(): ?string
    {
        return $this->menge;
    }

    public function setMenge(string $menge): self
    {
        $this->menge = $menge;

        return $this;
    }

    public function getNavId(): ?string
    {
        return $this->navId;
    }

    public function setNavId(string $navId): self
    {
        $this->navId = $navId;

        return $this;
    }

    public function getImage(): ?Images
    {
        return $this->image;
    }

    public function setImage(?Images $image): self
    {
        $this->image = $image;

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

    public function getFarbe(): ?Farbe
    {
        return $this->farbe;
    }

    public function setFarbe(?Farbe $farbe): self
    {
        $this->farbe = $farbe;

        return $this;
    }

    public function getKategorie(): ?Kategorie
    {
        return $this->kategorie;
    }

    public function setKategorie(?Kategorie $kategorie): self
    {
        $this->kategorie = $kategorie;

        return $this;
    }


}
