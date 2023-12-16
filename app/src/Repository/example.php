<?php

namespace App\Repository;

use App\Entity\Bitrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BitrixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bitrix::class);
    }

    public function set(string $memberId, string $accessToken, string $refreshToken, int $expiresOn, ?string $plan): Bitrix 
    {
        $record = $this->get($memberId);

        if (!$record) {
            $record = new Bitrix();
            $record->setMemberId($memberId);
        }

        $record->setAccessToken($accessToken);
        $record->setRefreshToken($refreshToken);
        $record->setExpiresOn($expiresOn);
        $record->setPlan($plan);

        $this->getEntityManager()->persist($record);
        $this->getEntityManager()->flush();

        return $record;
    }

    public function get(string $memberId): ?Bitrix
    {
        return $this->findOneBy(['memberId' => $memberId]);
    }
}
