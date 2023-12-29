<?php

/**
 * Preparation of options for display in the form
 */

 /**
  * todo Получения сущностей из Битрикс24 (лид, контакт, компания)
  * todo Получения получения полей из Битрикс24 (кроме полей типа array)
  */
declare(strict_types=1);

namespace App\Service;

use App\{
    Repository\ClientRepository,
    Repository\BitrixRepository,
    Exception\RecordNotFoundException,
};

class FormBitrixOptionsService 
{
    public function __construct(
        private ClientRepository $clientRepository,
        private BitrixRepository $bitrixRepository,
        private BitrixConnectorService $bitrixConnectorService
    )
    {
        
    }

    public function getOptions(string $memberId): array
    {
        $core = $this->bitrixConnectorService->getCore($memberId);

        // $result = $core->call('scope')->getResponseData()->getResult();
        $result = $core->call('batch', [
            'cmd' => [
                'fields_lead' => [
                    'method' => 'crm.lead.fields'
                ],
                'fields_contact' => [
                    'method' => 'crm.contact.fields'
                ],
                'fields_company' => [
                    'method' => 'crm.company.fields'
                ],
            ]
        ]);

        dd($result);

        return [];
    }


}