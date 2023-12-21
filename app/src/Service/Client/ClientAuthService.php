<?php

declare(strict_types=1);

namespace App\Service\Client;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;
use App\Entity\Bitrix;

class ClientAuthService 
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->$entityManager = $entityManager;
    }

    public function getClientByAccessToken(string $accessToken): ?Client
    {
        // return $this->clientRepository->findOneByAccessToken($accessToken);

        return null;
    }

    public function getClientByMemberId(string $memberId): Client
    {
        // $bitrix = $this->entityManager->getRepository(Bitrix::class)
    }

    
    private function create(): Client
    {
        $client = new Client();
        $client->setAccessToken('fdsfds');

        $this->entityManager->persist($client);
        $this->entityManager->flush();

        return $client;
    }

}