<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Field;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FieldRepository extends ServiceEntityRepository implements RepositioryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Field::class);
    }

    public function get(int $id): ?Field
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function add(Client $client, string $entityId, string $bitrixId, string $getresponseId): bool
    {
        $record = new Field();

        $record->setClient($client);
        $record->setEntityId($entityId);
        $record->setBitrixId($bitrixId);
        $record->setGetresponseId($getresponseId);
        $record->setExecutedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw')));

        $this->getEntityManager()->persist($record);
        $this->getEntityManager()->flush();

        return true;
    }

    public function upd(int $id, string $entityId, string $bitrixId, string $getresponseId): bool
    {
        $record = $this->find($id);
        $record->setEntityId($entityId);
        $record->setBitrixId($bitrixId);
        $record->setGetresponseId($getresponseId);
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
