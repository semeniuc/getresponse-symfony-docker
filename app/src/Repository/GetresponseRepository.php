<?php

namespace App\Repository;

use App\Entity\Getresponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Getresponse>
 *
 * @method Getresponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Getresponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Getresponse[]    findAll()
 * @method Getresponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GetresponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Getresponse::class);
    }

//    /**
//     * @return Getresponse[] Returns an array of Getresponse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Getresponse
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
