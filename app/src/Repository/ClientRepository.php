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

    public function findOneByMemberId(string $memberId): ?Client
    {
        // return $this->findOneBy(['memberId' => $memberId]);
        return $this->createQueryBuilder('c')
            ->leftJoin('c.bitrix', 'b')
            ->andWhere('b.memberId = :memberId')
            ->setParameter('memberId', $memberId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function add(): Client
    {
        $client = new Client();
        $client->setAccessToken('fsdf');

        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();

        return $client;
    }

    public function get(string $accessToken): ?Client
    {
        return $this->findOneBy(['accessToken' => $accessToken]);
    }

    public function upd(): bool
    {
        // $client = $this->
        // $client-
        return true;
    }

    public function del(): bool
    {
        // $this->
        return true;
    }
}
