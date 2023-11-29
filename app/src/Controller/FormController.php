<?php

namespace App\Controller;

use App\Form\LocaleType;
use App\Form\SettingsType;
use App\Service\ChangeLanguageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * Connect the view
     */
    #[Route('/form', name: 'form')]
    public function index(Request $request): Response
    {
        // Put data in form locale
        $formLocaleView = $this->createForm(type: LocaleType::class, options: [
            'select' => [
                'Pl' => 'pl',
                'En' => 'en',
                'Es' => 'es',
            ],
        ]);

        // Put data in form settings
        $formSettingsView = $this->createForm(type: SettingsType::class, options: [
            'api_key' => 'zlilo4vmja1trjye30sal1oeyqetv3gh',
            'list' => [
                'Dofinansowanie w ramach KFS dla Hotele lubański' => 'fdTrn65J',
                'Dofinansowanie w ramach KFS dla HoReCa Sokołów Podlaski' => 'lRKF534',
                'Dofinansowanie w ramach KFS dla HoReCa Iława' => 'QWEfd56'
            ],
            'events' => [
                ['event' => 'event_1', 'stage' => 'stage_1'],
                ['event_2' => 'event', 'stage_2' => 'stage'],
            ],
            'hook_url' => 'https://getresponse.beupsoft.pl/client=fc91abad728a1af85e86eff3d1e2424f',
            'pipeline' => [
                'Pipeline 1' => 'pipline_1',
                'Pipeline 2' => 'pipline_2',
                'Pipeline 3' => 'pipline_3',
            ],
        ]);

        // Render
        return $this->render('form/index.html.twig', [
            'lang_page' => 'pl',
            'locale'=> $formLocaleView,
            'form' => $formSettingsView,
        ]);
    }

    /**
     * Change language
     */
    #[Route('/set-locale', name:'set_locale')]
    public function setLocale(Request $request, ChangeLanguageService $changeLanguageService)
    {
        $form = $this->createForm(LocaleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $locale = $form->get('select')->getData();
            if (!empty($locale)) {
                $changeLanguageService->setLocale($locale);
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Update the settings
     */
    #[Route('/set-settings', name:'set_settings')]
    public function setSettings(Request $request)
    {
        $form = $this->createForm(SettingsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
        }

        return $this->redirect($request->headers->get('referer'));
    }
}