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
    private ?Section $section = null;

    #[ORM\Column(length: 20)]
    private ?string $entity = null;

    #[ORM\Column(length: 20)]
    private ?string $bitrix = null;

    #[ORM\Column(length: 20)]
    private ?string $getresponse = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $executedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): static
    {
        $this->section = $section;

        return $this;
    }

    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): static
    {
        $this->entity = $entity;

        return $this;
    }

    public function getBitrix(): ?string
    {
        return $this->bitrix;
    }

    public function setBitrix(string $bitrix): static
    {
        $this->bitrix = $bitrix;

        return $this;
    }

    public function getGetresponse(): ?string
    {
        return $this->getresponse;
    }

    public function setGetresponse(string $getresponse): static
    {
        $this->getresponse = $getresponse;

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
