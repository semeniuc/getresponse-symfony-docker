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

    #[ORM\Column(length: 100)]
    private ?string $bitrixId = null;

    #[ORM\Column(length: 100)]
    private ?string $bitrixDomain = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $bitrixPlan = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $getresponsePlan = null;

    #[ORM\Column(nullable: true)]
    private ?int $appVersion = null;

    #[ORM\Column(nullable: true)]
    private ?bool $appInstaled = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $executedAt = null;

    #[ORM\OneToOne(mappedBy: 'clientId', cascade: ['persist', 'remove'])]
    private ?Access $access = null;

    #[ORM\OneToOne(mappedBy: 'client', cascade: ['persist', 'remove'])]
    private ?Section $section = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBitrixId(): ?string
    {
        return $this->bitrixId;
    }

    public function setBitrixId(string $bitrixId): static
    {
        $this->bitrixId = $bitrixId;

        return $this;
    }

    public function getBitrixDomain(): ?string
    {
        return $this->bitrixDomain;
    }

    public function setBitrixDomain(string $bitrixDomain): static
    {
        $this->bitrixDomain = $bitrixDomain;

        return $this;
    }

    public function getBitrixPlan(): ?string
    {
        return $this->bitrixPlan;
    }

    public function setBitrixPlan(string $bitrixPlan): static
    {
        $this->bitrixPlan = $bitrixPlan;

        return $this;
    }

    public function getGetresponsePlan(): ?string
    {
        return $this->getresponsePlan;
    }

    public function setGetresponsePlan(?string $getresponsePlan): static
    {
        $this->getresponsePlan = $getresponsePlan;

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

    public function isAppInstaled(): ?bool
    {
        return $this->appInstaled;
    }

    public function setAppInstaled(?bool $appInstaled): static
    {
        $this->appInstaled = $appInstaled;

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

    public function getAccess(): ?Access
    {
        return $this->access;
    }

    public function setAccess(Access $access): static
    {
        // set the owning side of the relation if necessary
        if ($access->getClientId() !== $this) {
            $access->setClientId($this);
        }

        $this->access = $access;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(Section $section): static
    {
        // set the owning side of the relation if necessary
        if ($section->getClient() !== $this) {
            $section->setClient($this);
        }

        $this->section = $section;

        return $this;
    }
}
