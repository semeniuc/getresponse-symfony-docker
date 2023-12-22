<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function get(string $accessToken): ?Client
    {
        return $this->findOneBy(['accessToken' => $accessToken]);
    }

    public function add(string $accessToken): Client
    {
        $record = new Client();
        $record->setAccessToken($accessToken);
        $record->setExecutedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw')));

        $this->getEntityManager()->persist($record);
        $this->getEntityManager()->flush();

        return $record;
    }

    public function upd(int $id, string $accessToken): bool
    {
        $record = $this->find($id);
        $record->setAccessToken($accessToken);
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
