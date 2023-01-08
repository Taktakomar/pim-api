<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FlowRepository::class)
 */
class Flow
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
    private $context_name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activ = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\Type(type="\DateTime")
     */
    private $last_run_time  ;
    /**
     * @ORM\Column(type="bigint")
     */
    private $periodeInMin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $input_datei_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $output_datei_name;
    /**
     * @ORM\ManyToOne(targetEntity=VerbindungenArten::class, inversedBy="flows")
     */
    private $verbindungArtIdIn;
    /**
     * @ORM\ManyToOne(targetEntity=Sftp::class, inversedBy="flows")
     */
    private $sftp_Input_server_id;

    /**
     * @ORM\ManyToOne(targetEntity=Sftp::class, inversedBy="flows")
     */
    private $sftp_output_server_id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $flow_mappe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $display_name;

    /**
     * @ORM\ManyToOne(targetEntity=VerbindungenArten::class, inversedBy="flows")
     */
    private $verbinungartout;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $endpointString ="";

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastRunLog = "OK";

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContextName(): ?string
    {
        return $this->context_name;
    }

    public function setContextName(string $context_name): self
    {
        $this->context_name = $context_name;

        return $this;
    }

    public function isActiv(): ?bool
    {
        return $this->activ;
    }

    public function setActiv(bool $activ): self
    {
        $this->activ = $activ;

        return $this;
    }

    public function getLastRunTime(): ?\DateTimeInterface
    {
        return $this->last_run_time;
    }

    public function setLastRunTime(\DateTimeInterface $last_run_time): self
    {
        $this->last_run_time = $last_run_time;

        return $this;
    }

    public function getPeriodeInMin(): ?string
    {
        return $this->periodeInMin;
    }

    public function setPeriodeInMin(string $periodeInMin): self
    {
        $this->periodeInMin = $periodeInMin;

        return $this;
    }

    public function getInputDateiName(): ?string
    {
        return $this->input_datei_name;
    }

    public function setInputDateiName(string $input_datei_name): self
    {
        $this->input_datei_name = $input_datei_name;

        return $this;
    }

    public function getOutputDateiName(): ?string
    {
        return $this->output_datei_name;
    }

    public function setOutputDateiName(string $output_datei_name): self
    {
        $this->output_datei_name = $output_datei_name;

        return $this;
    }
    public function getVerbindungArtIdIn(): ?VerbindungenArten
    {
        return $this->verbindungArtIdIn;
    }

    public function setVerbindungArtIdIn(?VerbindungenArten $verbindungArtId): self
    {
        $this->verbindungArtIdIn = $verbindungArtId;

        return $this;
    }
    public function getSftpInputServerId(): ?Sftp
    {
        return $this->sftp_Input_server_id;
    }

    public function setSftpInputServerId(?Sftp $sftp_Input_server_id): self
    {
        $this->sftp_Input_server_id = $sftp_Input_server_id;

        return $this;
    }

    public function getSftpOutputServerId(): ?Sftp
    {
        return $this->sftp_output_server_id;
    }

    public function setSftpOutputServerId(?Sftp $sftp_output_server_id): self
    {
        $this->sftp_output_server_id = $sftp_output_server_id;

        return $this;
    }

    public function getFlowMappe(): ?string
    {
        return $this->flow_mappe;
    }

    public function setFlowMappe(string $flow_mappe): self
    {
        $this->flow_mappe = $flow_mappe;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->display_name;
    }

    public function setDisplayName(string $display_name): self
    {
        $this->display_name = $display_name;

        return $this;
    }

    public function getVerbinungartout(): ?VerbindungenArten
    {
        return $this->verbinungartout;
    }

    public function setVerbinungartout(?VerbindungenArten $verbinungartout): self
    {
        $this->verbinungartout = $verbinungartout;

        return $this;
    }

    public function getEndpointString(): ?string
    {
        return $this->endpointString;
    }

    public function setEndpointString(?string $endpointString): self
    {
        $this->endpointString = $endpointString;

        return $this;
    }

    public function getLastRunLog(): ?string
    {
        return $this->lastRunLog;
    }

    public function setLastRunLog(string $lastRunLog): self
    {
        $this->lastRunLog = $lastRunLog;

        return $this;
    }
}
