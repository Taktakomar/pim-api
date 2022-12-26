<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Defintionen
 *
 * @ORM\Table(name="defintionen")
 * @ORM\Entity(repositoryClass="App\Repository\DefintionenRepository")
 */
class Defintionen
{
    /**
     * @var int
     *
     * @ORM\Column(name="definition_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $definitionId;

    /**
     * @var string
     *
     * @ORM\Column(name="defintion_name", type="string", length=40, nullable=false)
     */
    private $defintionName;

    /**
     * @var string
     *
     * @ORM\Column(name="beschreibung", type="string", length=40, nullable=false)
     */
    private $beschreibung;

    public function getDefinitionId(): ?int
    {
        return $this->definitionId;
    }

    public function getDefintionName(): ?string
    {
        return $this->defintionName;
    }

    public function setDefintionName(string $defintionName): self
    {
        $this->defintionName = $defintionName;

        return $this;
    }

    public function getBeschreibung(): ?string
    {
        return $this->beschreibung;
    }

    public function setBeschreibung(string $beschreibung): self
    {
        $this->beschreibung = $beschreibung;

        return $this;
    }


}
