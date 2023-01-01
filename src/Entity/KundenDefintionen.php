<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KundenDefintionen
 *
 * @ORM\Table(name="kunden_defintionen", indexes={@ORM\Index(name="kunden_id", columns={"kunden_id"})})
  * @ORM\Entity(repositoryClass="App\Repository\KundenDefintionenRepository")
 */
class KundenDefintionen
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
     * @ORM\Column(name="template", type="text", length=0, nullable=false)
     */
    private $template;

    /**
     * @var \Kunden
     *
     * @ORM\ManyToOne(targetEntity="Kunden", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kunden_id", referencedColumnName="id")
     * })
     */
    private $kunden;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getKunden(): ?Kunden
    {
        return $this->kunden;
    }

    public function setKunden(?Kunden $kunden): self
    {
        $this->kunden = $kunden;

        return $this;
    }


}
