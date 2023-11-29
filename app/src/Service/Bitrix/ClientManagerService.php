<?php

namespace App\Service\Bitrix;

use App\Entity\Bitrix\Client;
use Doctrine\ORM\EntityManagerInterface;

class ClientManagerService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function set(
        string $memberId,
        string $domain,
        ?string $tariff,
        int $appVersion,
        bool $appInstaled,
        string $accessToken,
        string $refreshToken,
        int $expires
    ): Client {
        // Check if client already exists
        $existingClient = $this->get($memberId);
        if ($existingClient) {
            $client = $existingClient;
        } else {
            $client = new Client();
        }

        // Save keys
        $client->setMemberId($memberId);
        $client->setDomain($domain);
        $client->setTariff($tariff);
        $client->setAppVersion($appVersion);
        $client->setAppInstaled($appInstaled);
        $client->setAccessToken($accessToken);
        $client->setRefreshToken($refreshToken);
        $client->setExpires($expires);
        $client->setExecuted(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw')));

        $this->entityManager->persist($client);
        $this->entityManager->flush();

        return $client;
    }

    public function get(string $memberId): ?Client
    {
        return $this->entityManager->getRepository(Client::class)->findOneBy(['memberId' => $memberId]);
    }
}