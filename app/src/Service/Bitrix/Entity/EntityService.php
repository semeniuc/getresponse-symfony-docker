<?php 

declare(strict_types=1);

namespace App\Service\Bitrix\Entity;

use Bitrix24\SDK\Core\Core;
use Monolog\Logger;

class EntityService extends BuilderEntityService
{
    public function __construct(Core $core, Logger $logger)
    {
        parent::__construct($core, $logger);
    }

    public function getApiKey(): array
    {
        return $this->getItem('api_key', $this->sectionGetresponseSettingsId);
    }

    public function setApiKey(string $apiKey): void
    {
        $call = $this->getApiKey();

        if (isset($call[0]['ID']) && !empty($call)) {
            $this->updateItem(
                (int) $call[0]['ID'],
                ['value' => $apiKey]
            );
        } else {
            $this->setItem(
                'api_key',
                $this->sectionGetresponseSettingsId,
                ['value' => $apiKey]
            );
        }
    }

    public function getList(): array
    {
        return $this->getItem('list', $this->sectionGetresponseSettingsId);
    }

    public function setList(string $list): void
    {
        $call = $this->getList();

        if (isset($call[0]['ID']) && !empty($call)) {
            $this->updateItem(
                (int) $call[0]['ID'],
                ['value' => $list]
            );
        } else {
            $this->setItem(
                'list',
                $this->sectionGetresponseSettingsId,
                ['value' => $list]
            );
        }
    }
    
    public function getFields(string $bitrixFieldId = ''): array
    {
        if (!empty($bitrixFieldId)) {
            return $this->getItem('field', $this->sectionGetresponseFieldsId, ['field_bitrix' => $bitrixFieldId]);
        } else {
            return $this->getItem('field', $this->sectionGetresponseFieldsId);
        }
    }

    public function setField(string $entity, string $fieldBitrix, string $fieldGetresponse): void
    {
        $call = $this->getFields($fieldBitrix);

        if (isset($call[0]['ID']) && !empty($call)) {
            $this->updateItem(
                (int) $call[0]['ID'],
                [
                    'entity' => $entity,
                    'field_bitrix' => $fieldBitrix,
                    'field_getresponse' => $fieldGetresponse,
                ]
            );
        } else {
            $this->setItem(
                'field',
                $this->sectionGetresponseFieldsId,
                [
                    'entity' => $entity,
                    'field_bitrix' => $fieldBitrix,
                    'field_getresponse' => $fieldGetresponse,
                ]
            );
        }
    }

    public function deleteField(string $bitrixFieldId): void
    {
        $call = $this->getFields($bitrixFieldId);

        if (isset($call[0]['ID']) && !empty($call)) {
            $this->deleteItem((int) $call[0]['ID']);
        }
    }

    public function getHookUrl(): array
    {
        return $this->getItem('hook_url', $this->sectionBitrixSettingsId);
    }

    public function setHookUrl(string $hookUrl): void 
    {
        $call = $this->getHookUrl();

        if (isset($call[0]['ID']) && !empty($call)) {
            $this->updateItem(
                (int) $call[0]['ID'],
                ['value' => $hookUrl]
            );
        } else {
            $this->setItem(
                'hook_url',
                $this->sectionBitrixSettingsId,
                ['value' => $hookUrl]
            );
        }
    }

    public function getPipeline(): array
    {
        return $this->getItem('pipeline', $this->sectionBitrixSettingsId);
    }

    public function setPipeline(string $pipeline): void 
    {
        $call = $this->getPipeline();

        if (isset($call[0]['ID']) && !empty($call)) {
            $this->updateItem(
                (int) $call[0]['ID'],
                ['value' => $pipeline]
            );
        } else {
            $this->setItem(
                'pipeline',
                $this->sectionBitrixSettingsId,
                ['value' => $pipeline]
            );
        }
    }

    public function getEvents(string $event = ''): array
    {
        if (!empty($event)) {
            return $this->getItem('event', $this->sectionBitrixEventsId, ['event' => $event]);
        } else {
            return $this->getItem('event', $this->sectionBitrixEventsId);
        }
    }

    public function setEvent(string $actionGetresponse, string $stageBitrix)
    {
        $call = $this->getEvents($actionGetresponse);

        if (isset($call[0]['ID']) && !empty($call)) {
            $this->updateItem(
                (int) $call[0]['ID'],
                [
                    'action_getresponse' => $actionGetresponse,
                    'stage_bitrix' => $stageBitrix,
                ]
            );
        } else {
            $this->setItem(
                'event',
                $this->sectionBitrixEventsId,
                [
                    'action_getresponse' => $actionGetresponse,
                    'stage_bitrix' => $stageBitrix,
                ]
            );
        }
    }
}