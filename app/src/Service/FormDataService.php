<?php

/**
 * Preparation of data for display in the form
 * todo Реализовать обновление данных вместо удаления (fields, events)
 */

declare(strict_types=1);

namespace App\Service;

use App\{
    Entity\Client,
    Entity\Getresponse,
    Repository\ClientRepository,
    Repository\BitrixRepository,
    Repository\GetresponseRepository,
    Repository\SectionRepository,
    Repository\FieldRepository,
    Repository\EventRepository,
    Exception\RecordNotFoundException,
};

class FormDataService 
{
    public function __construct(
        private ClientRepository $clientRepository,
        private BitrixRepository $bitrixRepository,
        private GetresponseRepository $getresponseRepository,
        private SectionRepository $sectionRepository,
        private FieldRepository $fieldRepository,
        private EventRepository $eventRepository,
    ) {
        
    }

    /**
     * Summary of getData
     * @param string $memberId
     * @return array
     */
    public function getData(string $memberId): array
    {
        $client = $this->getClient($memberId);
        $getresponse = $this->getGetresponse($client);
        $section = $client->getSection();

        // hookUrl
        if ($client && $accessToken = $client->getAccessToken()) {
            $hookUrl = "https://getresponse.beupsoft.pl/{$accessToken}/";
        }

        // apiKey
        if ($getresponse) {
            $apiKey = $getresponse->getAccessToken();
        }

        // Fields
        if ($client->getFields() && $client->getFields()->toArray()) {
            $fields = array_map(function ($field) {
                return [
                    'entity' => $field->getEntityId(),
                    'bitrix' => $field->getBitrixId(),
                    'getresponse' => $field->getGetresponseId(),
                ];
            }, $client->getFields()->toArray());
        }

        // Events
        if ($client->getEvents() && $client->getEvents()->toArray()) {
            $events = array_map(function ($event) {
                return [
                    'type' => $event->getTypeId(),
                    'stage' => $event->getStageId(),
                ];
            }, $client->getEvents()->toArray());
        }

        return [
            'api_key'   => $apiKey ?? '',
            'hook_url'  => $hookUrl ?? '',
            'list'      => $section ? $section->getListId() : '',
            'pipeline'  => $section ? $section->getPipelineId() : '',
            'fields'    => $fields ?? [],
            'events'    => $events ?? [],
        ];
    }

    /**
     * Summary of setData
     * @param string $memberId
     * @param mixed $apiKey
     * @param mixed $listId
     * @param mixed $pipelineId
     * @param mixed $fieldsData
     * @param mixed $eventsData
     * @return void
     */
    public function setData(
        string $memberId,
        ?string $apiKey,
        ?string $listId,
        ?string $pipelineId,
        ?array $fieldsData,
        ?array $eventsData
    ): void
    {
        $client = $this->getClient($memberId);
        $getresponse = $this->getGetresponse($client);

        $section = $client->getSection();
        $fields = $client->getFields();
        $events = $client->getEvents();
        
        // Update apiKey
        if ($getresponse) {
            $this->getresponseRepository->upd($getresponse->getId(), null, $apiKey);
        } else {
            $this->getresponseRepository->add($client, null, $apiKey);
        }
        
        // Update listId, pipelineId
        if ($section) {
            $this->sectionRepository->upd($section->getId(), $listId, $pipelineId);
        } else {
            $this->sectionRepository->add($client, $listId, $pipelineId);
        }

        // Unset fields
        if ($fields) {
            $fieldsArray = $fields->toArray();
            array_walk($fieldsArray, function ($field) use ($client) {
                $client->removeField($field);
            });
        } 

        // Add fields
        if ($fieldsData !== null) {
            array_walk($fieldsData, function ($field) use ($client) {
                $this->fieldRepository->add(
                    $client,
                    (string) $field['entity'],
                    $field['bitrix'],
                    $field['getresponse']
                );
            });
        }

        // Unset events
        if ($events) {
            $eventsArray = $events->toArray();
            array_walk($eventsArray, function ($event) use ($client) {
                $client->removeEvent($event);
            });
        }

        // Add events
        if ($eventsData !== null) {
            array_walk($eventsData, function ($event) use ($client) {
                $this->eventRepository->add(
                    $client,
                    $event['type'],
                    $event['stage'],
                );
            });
        }
    }

    /**
     * Summary of getClient
     * @param string $memberId
     * @throws \App\Exception\RecordNotFoundException
     * @return \App\Entity\Client
     */
    private function getClient(string $memberId): Client
    {
        $result = $this->bitrixRepository->get($memberId)->getClient();
        if ($result === null) {
            throw new RecordNotFoundException('No record found for this client');
        }

        return $result;
    }

    /**
     * Summary of getGetresponse
     * @param \App\Entity\Client $client
     * @throws \App\Exception\RecordNotFoundException
     * @return \App\Entity\Getresponse
     */
    private function getGetresponse(Client $client): Getresponse
    {
        $result = $client->getGetresponse();
        if ($result === null) {
            throw new RecordNotFoundException('The getresponse record associated with the client was not found');
        }

        return $result;
    }
}
