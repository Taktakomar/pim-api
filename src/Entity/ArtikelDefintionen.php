<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArtikelDefintionen
 *
 * @ORM\Table(name="artikel_defintionen", indexes={@ORM\Index(name="artikel_id", columns={"artikel_id"}), @ORM\Index(name="definition_id", columns={"definition_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArtikelDefintionenRepository")
 */
class ArtikelDefintionen
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
     * @ORM\Column(name="inhalt", type="string", length=50, nullable=false)
     */
    private $inhalt;

    /**
     * @var \Artikel
     *
     * @ORM\ManyToOne(targetEntity="Artikel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artikel_id", referencedColumnName="artikel_id")
     * })
     */
    private $artikel;

    /**
     * @var \Defintionen
     *
     * @ORM\ManyToOne(targetEntity="Defintionen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="definition_id", referencedColumnName="definition_id")
     * })
     */
    private $definition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInhalt(): ?string
    {
        return $this->inhalt;
    }

    public function setInhalt(string $inhalt): self
    {
        $this->inhalt = $inhalt;

        return $this;
    }

    public function getArtikel(): ?Artikel
    {
        return $this->artikel;
    }

    public function setArtikel(?Artikel $artikel): self
    {
        $this->artikel = $artikel;

        return $this;
    }

    public function getDefinition(): ?Defintionen
    {
        return $this->definition;
    }

    public function setDefinition(?Defintionen $definition): self
    {
        $this->definition = $definition;

        return $this;
    }


}
