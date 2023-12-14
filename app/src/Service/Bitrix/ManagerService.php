<?php

namespace App\Service\Bitrix;

use App\Entity\Bitrix;
use Doctrine\ORM\EntityManagerInterface;

class ManagerService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function set(
        string $memberId,
        string $accessToken,
        string $refreshToken,
        int $expiresOn,
        ?string $plan
    ): Bitrix {
        // Check if client already exists
        $existingClient = $this->get($memberId);
        if ($existingClient) {
            $client = $existingClient;
        } else {
            $client = new Bitrix();
        }

        // Save keys
        $client->setMemberId($memberId);
        $client->setAccessToken($accessToken);
        $client->setRefreshToken($refreshToken);
        $client->setExpiresOn($expiresOn);
        $client->setPlan($plan);
        
        $this->entityManager->persist($client);
        $this->entityManager->flush();

        return $client;
    }

    public function get(string $memberId): ?Bitrix
    {
        return $this->entityManager->getRepository(Bitrix::class)->findOneBy(['memberId' => $memberId]);
    }
}