<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function findOneByAccessToken(string $accessToken): ?Client
    {
        return $this->findOneBy(['accessToken' => $accessToken]);
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
}
