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

    public function set(string $domainUrl, ?string $planId, string $memberId, string $accessToken, string $refreshToken, int $expiresOn): bool
    {
        $record = $this->get($memberId);

        if (!$record) {
            $client = new Client();
            $client->setAccessToken('fdfsd');

            $record = new Bitrix();
            $record->setClient($client);
            $record->setMemberId($memberId);
        }

        $record->setDomainUrl($domainUrl);
        $record->setPlanId($planId);

        $record->setAccessToken($accessToken);
        $record->setRefreshToken($refreshToken);
        $record->setExpiresOn($expiresOn);

        $this->getEntityManager()->persist($record);
        $this->getEntityManager()->flush();

        return true;
    }

    public function get(string $memberId): ?Bitrix
    {
        return $this->findOneBy(['memberId' => $memberId]);
    }
}
