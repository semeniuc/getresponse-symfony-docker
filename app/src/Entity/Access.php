<?php

namespace App\Entity;

use App\Repository\AccessRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessRepository::class)]
class Access
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'access', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\Column(length: 100)]
    private ?string $bitrixToken = null;

    #[ORM\Column(length: 100)]
    private ?string $bitrixRefreshToken = null;

    #[ORM\Column]
    private ?int $bitrixExpiresToken = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $getresponseToken = null;

    #[ORM\Column(length: 100)]
    private ?string $appToken = null;

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

    public function getBitrixToken(): ?string
    {
        return $this->bitrixToken;
    }

    public function setBitrixToken(?string $bitrixToken): static
    {
        $this->bitrixToken = $bitrixToken;

        return $this;
    }

    public function getBitrixRefreshToken(): ?string
    {
        return $this->bitrixRefreshToken;
    }

    public function setBitrixRefreshToken(?string $bitrixRefreshToken): static
    {
        $this->bitrixRefreshToken = $bitrixRefreshToken;

        return $this;
    }

    public function getBitrixExpiresToken(): ?int
    {
        return $this->bitrixExpiresToken;
    }

    public function setBitrixExpiresToken(?int $bitrixExpiresToken): static
    {
        $this->bitrixExpiresToken = $bitrixExpiresToken;

        return $this;
    }

    public function getGetresponseToken(): ?string
    {
        return $this->getresponseToken;
    }

    public function setGetresponseToken(?string $getresponseToken): static
    {
        $this->getresponseToken = $getresponseToken;

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
