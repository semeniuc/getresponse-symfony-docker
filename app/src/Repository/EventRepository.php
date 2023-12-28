<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EventRepository extends ServiceEntityRepository implements RepositioryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function get(int $id): ?Event
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function add(Client $client, string $typeId, string $stageId): bool
    {
        $record = new Event();

        $record->setClient($client);
        $record->setTypeId($typeId);
        $record->setStageId($stageId);
        $record->setExecutedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw')));

        $this->getEntityManager()->persist($record);
        $this->getEntityManager()->flush();

        return true;
    }

    public function upd(int $id, string $typeId, string $stageId): bool
    {
        $record = $this->find($id);
        $record->setTypeId($typeId);
        $record->setStageId($stageId);
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
