<?php

namespace App\EventListener\Bitrix;

use App\Service\Bitrix\ClientManagerService;
use Bitrix24\SDK\Events\AuthTokenRenewedEvent;

class AuthTokenListener
{
    private ClientManagerService $client;

    public function __construct(ClientManagerService $client)
    {
        $this->client = $client;
    }

    public function onAuthTokenRenewed(AuthTokenRenewedEvent $event): void
    {
        $client = $this->client->get($event->getRenewedToken()->getMemberId());

        // TODO - implement the request of the tariff and the application version
        $this->client->set(
            $event->getRenewedToken()->getMemberId(),
            $client->getDomain(),
            null,
            1,
            true,
            $event->getRenewedToken()->getAccessToken()->getAccessToken(),
            $event->getRenewedToken()->getAccessToken()->getRefreshToken(),
            $event->getRenewedToken()->getAccessToken()->getExpires()
        );
    }
}
