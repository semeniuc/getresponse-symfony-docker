<?php

declare(strict_types=1);

namespace App\Service;
use App\Entity\Client;
use App\Repository\BitrixRepository;
use App\Repository\ClientRepository;

class ClientAuthService 
{
    private BitrixRepository $bitrixRepository;
    private ClientRepository $clientRepository;

    public function __construct(BitrixRepository $bitrixRepository, ClientRepository $clientRepository)
    {
        $this->bitrixRepository = $bitrixRepository;
        $this->clientRepository = $clientRepository;
    }

    public function get(string $accessToken): ?Client
    {
        return $this->clientRepository->findOneByAccessToken($accessToken);
    }

    public function create(): ?Client
    {
        $client = new Client();
        $client->setAccessToken('generation');


    }
}