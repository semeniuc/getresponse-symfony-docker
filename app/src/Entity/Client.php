<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bitrix $bitrix = null;

    #[ORM\Column(length: 20)]
    private ?string $appToken = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $appDomain = null;

    #[ORM\Column(nullable: true)]
    private ?int $appVersion = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $executedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBitrix(): ?Bitrix
    {
        return $this->bitrix;
    }

    public function setBitrix(Bitrix $bitrix): static
    {
        $this->bitrix = $bitrix;

        return $this;
    }

    public function getAppToken(): ?string
    {
        return $this->appToken;
    }

    public function setAppToken(string $appToken): static
    {
        $this->appToken = $appToken;

        return $this;
    }

    public function getAppDomain(): ?string
    {
        return $this->appDomain;
    }

    public function setAppDomain(?string $appDomain): static
    {
        $this->appDomain = $appDomain;

        return $this;
    }

    public function getAppVersion(): ?int
    {
        return $this->appVersion;
    }

    public function setAppVersion(?int $appVersion): static
    {
        $this->appVersion = $appVersion;

        return $this;
    }

    public function getExecutedAt(): ?\DateTimeImmutable
    {
        return $this->executedAt;
    }

    public function setExecutedAt(\DateTimeImmutable $executedAt): static
    {
        $this->executedAt = $executedAt;

        return $this;
    }
}
