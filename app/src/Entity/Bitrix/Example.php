<?php

class Examle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, unique: true)]
    private ?string $memberId = null;

    #[ORM\Column(length: 100)]
    private ?string $domain = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $tariff = null;

    #[ORM\Column(nullable: true)]
    private ?int $appVersion = null;

    #[ORM\Column(nullable: true)]
    private ?bool $appInstaled = null;

    #[ORM\Column(length: 100)]
    private ?string $accessToken = null;

    #[ORM\Column(length: 100)]
    private ?string $refreshToken = null;

    #[ORM\Column]
    private ?int $expires_on = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $executed_at = null;

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

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getTariff(): ?string
    {
        return $this->tariff;
    }

    public function setTariff(?string $tariff): static
    {
        $this->tariff = $tariff;

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

    public function getAppInstaled(): ?bool
    {
        return $this->appInstaled;
    }

    public function setAppInstaled(?bool $appInstaled): static
    {
        $this->appInstaled = $appInstaled;

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

    public function getExpires(): ?int
    {
        return $this->expires_on;
    }

    public function setExpires(?int $expires_on): static
    {
        $this->expires_on = $expires_on;

        return $this;
    }

    public function getExecuted(): ?\DateTimeInterface
    {
        return $this->executed_at;
    }

    public function setExecuted(\DateTimeInterface $executed_at): static
    {
        $this->executed_at = $executed_at;

        return $this;
    }
}
