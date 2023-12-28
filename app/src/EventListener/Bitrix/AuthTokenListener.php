<?php

namespace App\EventListener\Bitrix;

use Bitrix24\SDK\Events\AuthTokenRenewedEvent;
use App\Service\BitrixManagerService;

class AuthTokenListener
{
    public function onAuthTokenRenewed(AuthTokenRenewedEvent $event, BitrixManagerService $bitrixManagerService): void
    {
        // TODO - implement the request of the tariff and the application version
        $bitrixManagerService->install(
            $event->getRenewedToken()->getDomain(),
            null,
            $event->getRenewedToken()->getMemberId(),
            $event->getRenewedToken()->getAccessToken()->getAccessToken(),
            $event->getRenewedToken()->getAccessToken()->getRefreshToken(),
        );
    }
}
