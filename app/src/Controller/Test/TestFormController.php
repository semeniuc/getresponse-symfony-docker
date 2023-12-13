<?php

namespace App\Controller\Test;

use App\Form\Test\TestEventType;
use App\Form\Test\TestSettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestFormController extends AbstractController
{
    #[Route('/test/form', name: 'test_form')]
    public function index(Request $request): Response
    {
        $formSettingsView = $this->createForm(
            type: TestSettingsType::class,
            data: [
                'api_key' => 'zlilo4vmja1trjye30sal1oeyqetv3gh',
                'hook_url' => 'https://getresponse.beupsoft.pl/client=fc91abad728a1af85e86eff3d1e2424f',
                'list' => 'fdTrn65J',
                'pipeline' => 'pipline_3',
                'events' => [
                    ['type' => 'event_1', 'stage' => 'stage_3'],
                    ['type' => 'event_3', 'stage' => 'stage_2'],
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
            ],
        );

        dump($formSettingsView->getConfig());

        // Render
        return $this->render('test/index.html.twig', [
            'lang_page' => 'pl',
            'form' => $formSettingsView,
        ]);
    }

    /**
     * Update the settings
     */
    #[Route('/test-set-settings', name: 'test_set_settings')]
    public function setSettings(Request $request)
    {
        $form = $this->createForm(TestSettingsType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
        }

        return $this->redirect($request->headers->get('referer'));
    }
}