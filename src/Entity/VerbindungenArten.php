<?php

namespace App\Entity;

use App\Repository\VerbindungenArtenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VerbindungenArtenRepository::class)
 */
class VerbindungenArten
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Flow::class, mappedBy="verbindungArtId")
     */
    private $flows;

    /**
     * @ORM\OneToMany(targetEntity=Flow::class, mappedBy="verbinungartout")
     */
    private $a;

    public function __construct()
    {
        $this->flows = new ArrayCollection();
        $this->a = new ArrayCollection();
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

    /**
     * @return Collection<int, Flow>
     */
    public function getFlows(): Collection
    {
        return $this->flows;
    }

    public function addFlow(Flow $flow): self
    {
        if (!$this->flows->contains($flow)) {
            $this->flows[] = $flow;
            $flow->setVerbindungArtIdIn($this);
        }

        return $this;
    }

    public function removeFlow(Flow $flow): self
    {
        if ($this->flows->removeElement($flow)) {
            // set the owning side to null (unless already changed)
            if ($flow->getVerbindungArtIdIn() === $this) {
                $flow->setVerbindungArtIdIn(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Flow>
     */
    public function getA(): Collection
    {
        return $this->a;
    }

    public function addA(Flow $a): self
    {
        if (!$this->a->contains($a)) {
            $this->a[] = $a;
            $a->setVerbinungartout($this);
        }

        return $this;
    }

    public function removeA(Flow $a): self
    {
        if ($this->a->removeElement($a)) {
            // set the owning side to null (unless already changed)
            if ($a->getVerbinungartout() === $this) {
                $a->setVerbinungartout(null);
            }
        }

        return $this;
    }
}
