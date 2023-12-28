<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Section;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Section::class);
    }

    public function get(string $memberId): ?Section
    {
        return $this->findOneBy(['memberId' => $memberId]);
    }

    public function add(Client $client, ?string $listId, ?string $pipelineId): bool
    {
        $record = new Section();

        $record->setClient($client);
        $record->setListId($listId);
        $record->setPipelineId($pipelineId);
        $record->setExecutedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw')));

        $this->getEntityManager()->persist($record);
        $this->getEntityManager()->flush();

        return true;
    }

    public function upd(int $id, ?string $listId, ?string $pipelineId): bool
    {
        $record = $this->find($id);
        $record->setListId($listId);
        $record->setPipelineId($pipelineId);
        $record->setExecutedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw')));

        $this->getEntityManager()->flush();

        return true;
    }

    public function del(int $id): bool
    {
        $record = $this->find($id);
        $record->remove();

        return true;
    }
}
