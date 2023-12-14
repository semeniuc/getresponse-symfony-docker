<?php

namespace App\EventListener\Bitrix;

use App\Repository\BitrixRepository;
use Bitrix24\SDK\Events\AuthTokenRenewedEvent;

class AuthTokenListener
{
    private BitrixRepository $manager;

    public function __construct(BitrixRepository $manager)
    {
        $this->manager = $manager;
    }

    public function onAuthTokenRenewed(AuthTokenRenewedEvent $event): void
    {
        // TODO - implement the request of the tariff and the application version
        $this->manager->set(
            $event->getRenewedToken()->getMemberId(),
            $event->getRenewedToken()->getAccessToken()->getAccessToken(),
            $event->getRenewedToken()->getAccessToken()->getRefreshToken(),
            $event->getRenewedToken()->getAccessToken()->getExpires(),
            null
        );
    }
}
