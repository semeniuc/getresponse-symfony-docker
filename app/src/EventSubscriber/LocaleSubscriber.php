<?php

namespace App\EventSubscriber;

use App\Service\ChangeLanguageService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleSubscriber implements EventSubscriberInterface
{
    private ChangeLanguageService $changeLanguageService;

    public function __construct(ChangeLanguageService $changeLanguageService)
    {
        $this->changeLanguageService = $changeLanguageService;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        // Define locale
        $locale = $this->changeLanguageService->getLocale();
        $event->getRequest()->setLocale($locale);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 101],
        ];
    }
}
