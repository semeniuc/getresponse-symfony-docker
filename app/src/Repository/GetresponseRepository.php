<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Getresponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GetresponseRepository extends ServiceEntityRepository implements RepositioryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Getresponse::class);
    }

    public function get(string $memberId): ?Getresponse
    {
        return $this->findOneBy(['memberId' => $memberId]);
    }

    public function add(Client $client, ?string $planId, string $accessToken): bool
    {
        $record = new Getresponse();

        $record->setClient($client);
        $record->setPlanId($planId);
        $record->setAccessToken($accessToken);
        $record->setExecutedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw')));

        $this->getEntityManager()->persist($record);
        $this->getEntityManager()->flush();

        return true;
    }

    public function upd(int $id, ?string $planId, string $accessToken): bool
    {
        $record = $this->find($id);
        $record->setPlanId($planId);
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
