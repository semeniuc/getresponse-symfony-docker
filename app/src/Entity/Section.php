<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?string $list = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $pipeline = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $executedAt = null;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: Field::class, orphanRemoval: true)]
    private Collection $fields;

    #[ORM\OneToMany(mappedBy: 'section', targetEntity: Event::class, orphanRemoval: true)]
    private Collection $events;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

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

    public function getList(): ?string
    {
        return $this->list;
    }

    public function setList(?string $list): static
    {
        $this->list = $list;

        return $this;
    }

    public function getPipeline(): ?string
    {
        return $this->pipeline;
    }

    public function setPipeline(?string $pipeline): static
    {
        $this->pipeline = $pipeline;

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

    /**
     * @return Collection<int, Field>
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function addField(Field $field): static
    {
        if (!$this->fields->contains($field)) {
            $this->fields->add($field);
            $field->setSection($this);
        }

        return $this;
    }

    public function removeField(Field $field): static
    {
        if ($this->fields->removeElement($field)) {
            // set the owning side to null (unless already changed)
            if ($field->getSection() === $this) {
                $field->setSection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setSection($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getSection() === $this) {
                $event->setSection(null);
            }
        }

        return $this;
    }
}
