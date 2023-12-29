<?php

namespace App\EventListener\Bitrix;

use Bitrix24\SDK\Events\AuthTokenRenewedEvent;
use App\Service\BitrixManagerService;

class AuthTokenListener
{
    public function __construct(private BitrixManagerService $bitrixManagerService)
    {
    }

    public function onAuthTokenRenewed(AuthTokenRenewedEvent $event): void
    {
        // TODO - implement the request of the tariff and the application version
        $this->bitrixManagerService->install(
            $event->getRenewedToken()->getDomain(),
            null,
            $event->getRenewedToken()->getMemberId(),
            $event->getRenewedToken()->getAccessToken()->getAccessToken(),
            $event->getRenewedToken()->getAccessToken()->getRefreshToken(),
        );
    }
}
