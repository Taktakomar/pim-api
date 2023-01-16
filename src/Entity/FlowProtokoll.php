<?php

namespace App\Entity;

use App\Repository\FlowProtokollRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="flow_protokoll")
 * @ORM\Entity(repositoryClass=FlowProtokollRepository::class)
 */
class FlowProtokoll
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \Flow
     *
     * @ORM\ManyToOne(targetEntity="Flow")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="flow_id_id", referencedColumnName="id")
     * })
     */
    private $flow_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $protkoll_run_time;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $log_info;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $log_error_or_succes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlowId(): ?Flow
    {
        return $this->flow_id;
    }

    public function setFlowId(?Flow $flow_id): self
    {
        $this->flow_id = $flow_id;

        return $this;
    }

    public function getProtkollRunTime(): ?\DateTimeInterface
    {
        return $this->protkoll_run_time;
    }

    public function setProtkollRunTime(\DateTimeInterface $protkoll_run_time): self
    {
        $this->protkoll_run_time = $protkoll_run_time;

        return $this;
    }

    public function getLogInfo(): ?string
    {
        return $this->log_info;
    }

    public function setLogInfo(string $log_info): self
    {
        $this->log_info = $log_info;

        return $this;
    }

    public function getLogErrorOrSucces(): ?string
    {
        return $this->log_error_or_succes;
    }

    public function setLogErrorOrSucces(string $log_error_or_succes): self
    {
        $this->log_error_or_succes = $log_error_or_succes;

        return $this;
    }
}
