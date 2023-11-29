<?php


namespace App\Service\Bitrix\Entity;

use Bitrix24\SDK\Core\Core;
use Bitrix24\SDK\Services\AbstractService;
use Monolog\Logger;

class TestEnityService extends AbstractService
{
    private string $appStorageId = 'beup_getresponse';
    private string $appStorageName = 'beup_getresponse';
    private array $storageSections = [
        'keys' => [
            'apiKey' => '',
            'list' => '',
        ],
    ];
    private array $storageStructure = [
        'apiKey' => [
            'type'      => 'S',
        ],
        'list' => [
            'type'      => 'S',
        ],
        'getresponse' => [
            'apiKey' => '',
            'list' => '',
            'field' => [
                'leads' => [
                    'EMAIL' => '',
                    'PHONE' => '',
                    'TITLE' => '',
                ],
                'contacts' => [],
                'companies' => [],
            ],
        ],
        'bitrix' => [
            'hookUrl' => '',
            'pipeline' => '',
            'stage' => [
                'linkClicked' => '',
                'messageOpened' => '',
                'contactUnsubscribed' => '',
            ],
        ],
    ];

    public function __construct(Core $core, Logger $logger)
    {
        parent::__construct($core, $logger);
    }

    public function setEntity()
    {
        // $result = false;

        $call = $this->core->call('entity.add', [
            'ENTITY' => $this->appStorageId,
            'NAME' => $this->appStorageName,
        ])->getResponseData()->getResult();

        return $call;
    }

    public function getEntity(): array
    {
        $result = [];

        try {
            $result = $this->core->call('entity.get', ['ENTITY' => $this->appStorageId])->getResponseData()->getResult();
        } catch (\Throwable $th) {
            $result = $this->setEntity();
        }

        return $result;
    }

    public function setProperty()
    {
        $result = false;

        $call = $this->core->call('entity.item.property.add', [
            'ENTITY'    => $this->appStorageId,
            'PROPERTY'  => 'getresponse',
            'NAME'      => 'GetResponse',
            'TYPE'      => 'S',
        ])->getResponseData()->getResult();

        return $call;
    }


}