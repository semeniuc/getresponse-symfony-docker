<?php

namespace App\Repository;

use App\Entity\Bitrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bitrix>
 *
 * @method Bitrix|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bitrix|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bitrix[]    findAll()
 * @method Bitrix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BitrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bitrix::class);
    }

//    /**
//     * @return Bitrix[] Returns an array of Bitrix objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Bitrix
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
