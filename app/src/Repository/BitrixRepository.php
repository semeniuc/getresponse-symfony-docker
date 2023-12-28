<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Bitrix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BitrixRepository extends ServiceEntityRepository implements RepositioryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bitrix::class);
    }

    public function get(string $memberId): ?Bitrix
    {
        return $this->findOneBy(['memberId' => $memberId]);
    }

    public function add(Client $client, string $domainUrl, ?string $planId, string $memberId, string $accessToken, string $refreshToken, int $expiresOn): bool
    {
        $record = new Bitrix();

        $record->setClient($client);
        $record->setMemberId($memberId);
        $record->setDomainUrl($domainUrl);
        $record->setPlanId($planId);
        $record->setAccessToken($accessToken);
        $record->setRefreshToken($refreshToken);
        $record->setExpiresOn($expiresOn);
        $record->setExecutedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw')));

        $this->getEntityManager()->persist($record);
        $this->getEntityManager()->flush();

        return true;
    }

    public function upd(int $id, string $domainUrl, ?string $planId, string $memberId, string $accessToken, string $refreshToken, int $expiresOn): bool
    {
        $record = $this->find($id);
        $record->setDomainUrl($domainUrl);
        $record->setPlanId($planId);
        $record->setAccessToken($accessToken);
        $record->setRefreshToken($refreshToken);
        $record->setExpiresOn($expiresOn);
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
