<?php

/**
 * Preparation of data for display in the form
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

    public function getData(string $memberId): array
    {
        $client = $this->getClient($memberId);
        $getresponse = $this->getGetresponse($client);

        $section = $client->getSection();
        $fields = $client->getFields();
        $events = $client->getEvents();

        return [
            'api_key'   => $getresponse->getAccessToken() ?? '',
            'hook_url'  => $client->getAccessToken() ?? '',
            'list'      => $section ? $section->getListId() : '',
            'pipeline'  => $section ? $section->getPipelineId() : '',
            'fields'    => $fields ? $fields->toArray() : [],
            'events'    => $events ? $events->toArray() : [],
        ];
    }

    public function setData(
        string $memberId,
        string $apiKey,
        string $listId,
        string $pipelineId,
        array $events,
        array $fields
    ): void
    {
        $client = $this->getClient($memberId);
        
        // apiKey
        $this->clientRepository->upd($client->getId(), $apiKey);

        // listId, pipelineId
        if ($section = $client->getSection()) {
            $this->sectionRepository->upd($section->getId(), $listId, $pipelineId);
        } else {
            $this->sectionRepository->add($client, $listId, $pipelineId);
        }

        // events
        if ($events = $client->getSection()) {
            // $this->eventRepository->
        }

    }

    private function getClient(string $memberId): Client
    {
        $result = $this->bitrixRepository->get($memberId)->getClient();
        if ($result === null) {
            throw new RecordNotFoundException('No record found for this client');
        }

        return $result;
    }

    private function getGetresponse(Client $client): Getresponse
    {
        $result = $client->getGetresponse();
        if ($result === null) {
            throw new RecordNotFoundException('The getresponse record associated with the client was not found');
        }

        return $result;
    }
}