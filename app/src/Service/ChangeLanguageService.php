<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class ChangeLanguageService
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function setLocale(string $locale): void
    {
        $this->requestStack->getSession()->set('_locale', $locale);
    }

    public function getLocale(): string
    {
        // Check session
        $locale = $this->requestStack->getSession()->get('_locale');
        if (!empty($locale)) {
            return $locale;
        }

        // Check request
        $request = $this->requestStack->getCurrentRequest();
        if ($request) {
            $locale = $request->getLocale();
            $this->setLocale($locale);
            return $locale;
        }

        return 'en';
    }
}