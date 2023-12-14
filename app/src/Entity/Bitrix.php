<?php

namespace App\Entity;

use App\Repository\BitrixRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BitrixRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Bitrix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $memberId = null;

    #[ORM\Column(length: 20)]
    private ?string $accessToken = null;

    #[ORM\Column(length: 20)]
    private ?string $refreshToken = null;

    #[ORM\Column]
    private ?int $expiresOn = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $plan = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $executedAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPlan(): ?string
    {
        return $this->plan;
    }

    public function setPlan(?string $plan): static
    {
        $this->plan = $plan;

        return $this;
    }

    public function getExecutedAt(): ?\DateTimeImmutable
    {
        return $this->executedAt;
    }

    #[ORM\PrePersist]
    public function setExecutedAt(): static
    {
        $this->executedAt = new \DateTimeImmutable();

        return $this;
    }
}
