<?php

namespace App\Entity;

use App\Repository\FieldRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FieldRepository::class)]
class Field
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fields')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\Column(length: 10)]
    private ?string $entityId = null;

    #[ORM\Column(length: 10)]
    private ?string $bitrixId = null;

    #[ORM\Column(length: 10)]
    private ?string $getresponseId = null;

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

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getEntityId(): ?string
    {
        return $this->entityId;
    }

    public function setEntityId(string $entityId): static
    {
        $this->entityId = $entityId;

        return $this;
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

    public function getGetresponseId(): ?string
    {
        return $this->getresponseId;
    }

    public function setGetresponseId(string $getresponseId): static
    {
        $this->getresponseId = $getresponseId;

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
