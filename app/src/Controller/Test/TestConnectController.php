<?php

namespace App\Controller\Test;

use App\Service\BitrixConnectorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestConnectController extends AbstractController
{
    #[Route('/test/connect', name: 'bitrix_connect')]
    public function index(Request $request, BitrixConnectorService $bitrixConnectorService): JsonResponse
    {
        $request->request->set('member_id', 'fc91abad728a1af85e86eff3d1e2424f');

        // Create core
        $core = $bitrixConnectorService->getCore($request->request->get('member_id'));
        $logger = $bitrixConnectorService->getLogger();

        return $this->json([
            'core' => $core
        ]);

        // $call = new \Bitrix24\SDK\Services\Main\Service\Main($core, $logger);
        // $result = $call->getCurrentScope()->getResponseData()->getResult();

        // $call = new EntityService($core, $logger);
        // $result = $call->getSection('beup_getresponse', 'section_bitrix');
        // $result = $call->getProperty('beup_getresponse', 'value');

        // $result = $core->call('entity.section.get', [
        //     'ENTITY' => 'beup_getresponse',
        // ])->getResponseData()->getResult();

        // $result = $core->call('entity.item.property.get', [
        //     'ENTITY' => 'beup_getresponse',
        //     'PROPERTY' => 'stage_bitrix',
        // ])->getResponseData()->getResult();

        // $call->setApiKey('FDSFSD5435GDF54645_2423423GDFGDF');
        // $call->setList('Bitrix24 - GetResponse');
        // $call->setField('lead', 'UF_CRM_1688713826297', 'FDS435H');
        // $call->deleteField('UF_CRM_1688713826297');

        // $call->setHookUrl('https://beup.io');
        // $call->setPipeline('GTHGY56H');
        // $call->setEvent('Subcsription', 'C69:NEW');

        // $apiKey = $call->getApiKey();
        // $list = $call->getList();
        // $fields = $call->getFields();
        // $hookUrl = $call->getHookUrl();
        // $pipeline = $call->getPipeline();
        // $events = $call->getEvents();

        // return $this->json([
        //     'apiKey' => $apiKey,
        //     'list' => $list,
        //     'fields' => $fields,
        //     'hookUrl' => $hookUrl,
        //     'pipeline' => $pipeline,
        //     'events' => $events,
        // ]);
    }
}
