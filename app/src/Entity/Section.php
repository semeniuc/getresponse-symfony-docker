<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'section', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $getresponse = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $bitrix = null;

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

    public function getGetresponse(): ?string
    {
        return $this->getresponse;
    }

    public function setGetresponse(?string $getresponse): static
    {
        $this->getresponse = $getresponse;

        return $this;
    }

    public function getBitrix(): ?string
    {
        return $this->bitrix;
    }

    public function setBitrix(?string $bitrix): static
    {
        $this->bitrix = $bitrix;

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
