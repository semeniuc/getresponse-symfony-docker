<?php

declare(strict_types=1);
namespace App\Service;

use App\Repository\ClientRepository;
use App\Repository\BitrixRepository;

class BitrixManagerService
{
    public function __construct(
        private ClientRepository $clientRepository,
        private BitrixRepository $bitrixRepository
    ) {
    }

    public function install(string $domainUrl, ?string $planId, string $memberId, string $accessToken, string $refreshToken): bool
    {
        $bitrix = $this->bitrixRepository->get($memberId);
        if ($bitrix === null) {
            // Create client
            $this->clientRepository->add('accessToken');
            $client = $this->clientRepository->get('accessToken');

            // Create bitrix
            $this->bitrixRepository->add(
                $client,
                $domainUrl,
                $planId,
                $memberId,
                $accessToken,
                $refreshToken,
                (new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw')))->modify('+3590 seconds')->getTimestamp(),
            );
        } else if ($id = $bitrix->getId()) {
            $this->bitrixRepository->upd(
                $id,
                $domainUrl,
                $planId,
                $memberId,
                $accessToken,
                $refreshToken,
                (new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw')))->modify('+3590 seconds')->getTimestamp(),
            );
        }

        return true;
    }

    public function unistall()
    {

    }
}