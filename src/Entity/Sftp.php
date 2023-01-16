<?php

namespace App\Entity;

use App\Repository\SftpRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sftp")
 * @ORM\Entity(repositoryClass=SftpRepository::class)
 */
class Sftp
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer" , nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $server;

    /**
     * @ORM\Column(type="integer")
     */
    private $sever_port;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $server_user_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serverPassword;
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $art;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $account_name;

    public function __construct()
    {
        $this->flows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServer(): ?string
    {
        return $this->server;
    }

    public function setServer(string $server): self
    {
        $this->server = $server;

        return $this;
    }

    public function getSeverPort(): ?int
    {
        return $this->sever_port;
    }

    public function setSeverPort(int $sever_port): self
    {
        $this->sever_port = $sever_port;

        return $this;
    }

    public function getServerUserName(): ?string
    {
        return $this->server_user_name;
    }

    public function setServerUserName(string $server_user_name): self
    {
        $this->server_user_name = $server_user_name;

        return $this;
    }

    public function getServerPassword(): ?string
    {
        return $this->serverPassword;
    }

    public function setServerPassword(string $serverPassword): self
    {
        $this->serverPassword = $serverPassword;

        return $this;
    }

    public function getArt(): ?string
    {
        return $this->art;
    }

    public function setArt(string $art): self
    {
        $this->art = $art;

        return $this;
    }

    public function getAccountName(): ?string
    {
        return $this->account_name;
    }

    public function setAccountName(string $account_name): self
    {
        $this->account_name = $account_name;

        return $this;
    }
}
