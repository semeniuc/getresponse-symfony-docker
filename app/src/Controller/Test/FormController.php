<?php

namespace App\Controller\Test;

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
    #[Route('/test/form2', name: 'form')]
    public function index(Request $request): Response
    {
        // Put data in form locale
        // $formLocaleView = $this->createForm(type: LocaleType::class, options: [
        //     'select' => [
        //         'Pl' => 'pl',
        //         'En' => 'en',
        //         'Es' => 'es',
        //     ],
        // ]);

        // Put data in form settings
        $formSettingsView = $this->createForm(
            type: SettingsType::class,
            data: [
                'api_key' => 'zlilo4vmja1trjye30sal1oeyqetv3gh',
                'hook_url' => 'https://getresponse.beupsoft.pl/client=fc91abad728a1af85e86eff3d1e2424f',
                'list' => 'fdTrn65J',
                'pipeline' => 'pipline_3',
                'events' => [
                    ['type' => 'event_1', 'stage' => 'stage_3'],
                    ['type' => 'event_3', 'stage' => 'stage_2'],
                ],
                'fields' => [
                    ['entity' => 1, 'bitrix' => 'field_1', 'getresponse' => 'field_1'],
                    ['entity' => 3, 'bitrix' => 'field_1', 'getresponse' => 'field_1'],
                    ['entity' => 4, 'bitrix' => 'field_1', 'getresponse' => 'field_1'],
                ],
            ],
            options: [
                'list_choices' => [
                    'Dofinansowanie w ramach KFS dla Hotele lubański' => 'fdTrn65J',
                    'Dofinansowanie w ramach KFS dla HoReCa Sokołów Podlaski' => 'lRKF534',
                    'Dofinansowanie w ramach KFS dla HoReCa Iława' => 'QWEfd56'
                ],
                'pipeline_choices' => [
                    'Pipeline 1' => 'pipline_1',
                    'Pipeline 2' => 'pipline_2',
                    'Pipeline 3' => 'pipline_3',
                ],
                'event_type_choices' => [
                    'Event 1' => 'event_1',
                    'Event 2' => 'event_2',
                    'Event 3' => 'event_3',
                ],
                'event_stage_choices' => [
                    'Stage 1' => 'stage_1',
                    'Stage 2' => 'stage_2',
                    'Stage 3' => 'stage_3',
                ],
                'field_entity_choices' => [
                    'Lead' => 1,
                    'Contact' => 3,
                    'Company' => 4,
                ],
                'field_bitrix_choices' => [
                    'Email' => 'field_1',
                    'Phone' => 'field_2',
                    'Name'  => 'field_3',
                ],
                'field_getresponse_choices' => [
                    'E-mail' => 'field_1',
                    'Number phone' => 'field_2',
                    'Title' => 'field_3',
                ],
            ],
        );

        // Render
        return $this->render('form/index.html.twig', [
            'lang_page' => 'pl',
            // 'locale'=> $formLocaleView,
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