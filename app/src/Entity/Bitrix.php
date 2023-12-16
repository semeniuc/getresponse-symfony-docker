<?php

namespace App\Entity;

use App\Repository\BitrixRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BitrixRepository::class)]
class Bitrix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'bitrix', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\Column(length: 100)]
    private ?string $domainUrl = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $planId = null;

    #[ORM\Column(length: 50)]
    private ?string $memberId = null;

    #[ORM\Column(length: 50)]
    private ?string $accessToken = null;

    #[ORM\Column(length: 50)]
    private ?string $refreshToken = null;

    #[ORM\Column]
    private ?int $expiresOn = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $executedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getDomainUrl(): ?string
    {
        return $this->domainUrl;
    }

    public function setDomainUrl(string $domainUrl): static
    {
        $this->domainUrl = $domainUrl;

        return $this;
    }

    public function getPlanId(): ?string
    {
        return $this->planId;
    }

    public function setPlanId(?string $planId): static
    {
        $this->planId = $planId;

        return $this;
    }

    public function getMemberId(): ?string
    {
        return $this->memberId;
    }

    public function setMemberId(string $memberId): static
    {
        $this->memberId = $memberId;

        return $this;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): static
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(string $refreshToken): static
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    public function getExpiresOn(): ?int
    {
        return $this->expiresOn;
    }

    public function setExpiresOn(int $expiresOn): static
    {
        $this->expiresOn = $expiresOn;

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
