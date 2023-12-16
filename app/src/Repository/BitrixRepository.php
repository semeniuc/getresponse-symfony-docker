<?php

namespace App\Repository;

use App\Entity\Client;
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

    public function set(Client $client, string $domainUrl, ?string $planId, string $memberId, string $accessToken, string $refreshToken, int $expiresOn): Bitrix
    {
        $record = $this->get($memberId);

        if (!$record) {
            $record = new Bitrix();
            $record->setMemberId($memberId);
        }

        $record->setAccessToken($accessToken);
        $record->setRefreshToken($refreshToken);
        $record->setExpiresOn($expiresOn);
        $record->setPlanId($planId);

        $this->getEntityManager()->persist($record);
        $this->getEntityManager()->flush();

        return $record;
    }

    public function get(string $memberId): ?Bitrix
    {
        return $this->findOneBy(['memberId' => $memberId]);
    }
}
