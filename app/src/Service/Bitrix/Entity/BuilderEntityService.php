<?php

declare(strict_types=1);

namespace App\Service\Bitrix\Entity;

use Bitrix24\SDK\Core\Core;
use Bitrix24\SDK\Services\AbstractService;
use Monolog\Logger;

/**
 * Structure of the application storage
 * - section: GetResponse
 * -- section: Settings [params: value]
 * --- api_key
 * --- list
 * -- section: Fields [params: entity, field_bitrix, field_getresponse]
 * --- field
 * 
 * - section: Bitrix
 * -- section: Settings [params: value]
 * --- hook_url
 * --- pipeline
 * -- section: Events [params: action_getresponse, stage_bitrix]
 * --- event
 */

class BuilderEntityService extends AbstractService
{
    private array $structure = [
        'entity' => [
            'name' => 'beup_getresponse',
        ],
        'sections' => [
            'getresponse' => [
                'name' => 'section_getresponse',
                'sections' => [
                    'settings' => [
                        'name' => 'section_getresponse_settings',
                        'items' => [
                            'api_key',
                            'list',
                        ],
                        'params' => [
                            'value',
                        ],
                    ],
                    'fields' =>[
                        'name' => 'section_getresponse_fields',
                        'items' => [
                            'field',
                        ],
                        'params' => [
                            'entity',
                            'field_bitrix',
                            'field_getresponse',
                        ],
                    ],
                ],
            ],
            'bitrix' => [
                'name' => 'section_bitrix',
                'sections' => [
                    'settings' => [
                        'name' => 'section_bitrix_settings',
                        'items' => [
                            'hook_url',
                            'pipeline',
                        ],
                        'params' => [
                            'value',
                        ],
                    ],
                    'events' => [
                        'name' => 'section_bitrix_events',
                        'items' => [
                            'event',
                        ],
                        'params' => [
                            'action_getresponse',
                            'stage_bitrix',
                        ],
                    ],
                ],
            ],
        ],
    ];
    private string $entityName;
    private int $sectionGetresponseId;
    private int $sectionBitrixId;
    protected int $sectionGetresponseSettingsId;
    protected int $sectionGetresponseFieldsId;
    protected int $sectionBitrixSettingsId;
    protected int $sectionBitrixEventsId;

    public function __construct(Core $core, Logger $logger)
    {
        parent::__construct($core, $logger);

        // Get entity
        $this->entityName = $this->getEntity($this->structure['entity']['name']);

        // Get sections of GetResponse
        $this->sectionGetresponseId = $this->getSection($this->structure['sections']['getresponse']['name']);
        $this->sectionGetresponseSettingsId = $this->getSection(
            $this->structure['sections']['getresponse']['sections']['settings']['name'], 
            $this->sectionGetresponseId
        );
        $this->sectionGetresponseFieldsId = $this->getSection( 
            $this->structure['sections']['getresponse']['sections']['fields']['name'], 
            $this->sectionGetresponseId
        );

        // Get sections of Bitrix
        $this->sectionBitrixId = $this->getSection($this->structure['sections']['bitrix']['name']);
        $this->sectionBitrixSettingsId = $this->getSection(
            $this->structure['sections']['bitrix']['sections']['settings']['name'], 
            $this->sectionBitrixId
        );
        $this->sectionBitrixEventsId = $this->getSection(
            $this->structure['sections']['bitrix']['sections']['events']['name'], 
            $this->sectionBitrixId
        );


        // Get properties
        $this->getProperty('value');
        $this->getProperty('entity');
        $this->getProperty('field_bitrix');
        $this->getProperty('field_getresponse');
        $this->getProperty('action_getresponse');
        $this->getProperty('stage_bitrix');
    }

    private function executeQuery(string $method, array $params = []): array
    {
        try {
            return $this->core->call($method, $params)->getResponseData()->getResult();
        } catch (\Exception $ex) {
            return [];
        }
    }

    private function getEntity(string $entityName): string
    {
        $call = $this->executeQuery('entity.get', [
            'ENTITY' => $entityName,
        ]);

        if (empty($call)) {
            if ($this->setEntity($entityName)) {
                return $this->getEntity($entityName);
            } else {
                throw new \Exception('Error create entity: ' . $entityName);
            }
        }

        return $entityName;
    }

    private function setEntity(string $entityName): bool
    {
        $call = $this->executeQuery('entity.add', [
            'ENTITY' => $entityName,
            'NAME' => $entityName,
        ]);

        if (empty($call)) {
            throw new \Exception('Error create entity: ' . $entityName);
        }

        return true;
    }

    private function getSection(string $sectionName, $parentSectionId = 0): int
    {
        $call = $this->executeQuery('entity.section.get', [
            'ENTITY' => $this->entityName,
            'FILTER' => [
                'NAME' => $sectionName,
            ],
        ]);

        if (!isset($call[0]['ID']) || empty($call[0]['ID'])) {
            if ($this->setSection($sectionName, $parentSectionId)) {
                return $this->getSection($sectionName, $parentSectionId);
            } else {
                throw new \Exception('Error create section: ' . $sectionName);
            }
        }

        return (int) $call[0]['ID'];
    }

    private function setSection(string $sectionName, int $parentSectionId): bool
    {
        $call = $this->executeQuery('entity.section.add', [
            'ENTITY' => $this->entityName,
            'NAME' => $sectionName,
            'SECTION' => $parentSectionId,
        ]);

        if (empty($call)) {
            throw new \Exception('Error create section: ' . $sectionName);
        }

        return true;
    }

    private function getProperty(string $propertyName): bool
    {
        $call = $this->executeQuery('entity.item.property.get', [
            'ENTITY' => $this->entityName,
            'PROPERTY' => $propertyName,
        ]);

        if (empty($call)) {
            if ($this->setProperty($propertyName)) {
                return $this->getProperty($propertyName);
            } else {
                throw new \Exception('Error create property: ' . $propertyName);
            }
        }

        return true;
    }

    private function setProperty(string $propertyName): bool
    {
        $call = $this->executeQuery('entity.item.property.add', [
            'ENTITY' => $this->entityName,
            'PROPERTY' => $propertyName,
            'NAME' => $propertyName,
            'TYPE' => 'S',
        ]);

        if (empty($call)) {
            throw new \Exception('Error create property: ' . $propertyName);
        }

        return true;
    }

    protected function getItem(string $itemName, int $sectionId, array $additionalFilter = []): array
    {
        $data = [
            'NAME' => $itemName,
            'SECTION' => $sectionId,
        ];

        if (!empty($additionalFilter)) {
            $data = array_merge($data, $additionalFilter);
        }

        return $this->executeQuery('entity.item.get', [
            'ENTITY' => $this->entityName,
            'FILTER' => $data,
        ]);
    }

    protected function setItem(string $itemName, int $sectionId, array $fields = []): bool
    {
        $call = $this->executeQuery('entity.item.add', [
            'ENTITY' => $this->entityName,
            'NAME' => $itemName,
            'SECTION' => $sectionId,
            'PROPERTY_VALUES' => $fields,
        ]);

        if (empty($call)) {
            throw new \Exception('Error create item: ' . $itemName);
        }

        return true;
    }

    protected function updateItem(int $itemId, array $fields = []): bool
    {
        $call = $this->executeQuery('entity.item.update', [
            'ENTITY' => $this->entityName,
            'ID' => $itemId,
            'PROPERTY_VALUES' => $fields,
        ]);

        if (empty($call)) {
            throw new \Exception('Error update item: ' . $itemId);
        }

        return true;
    }

    protected function deleteItem(int $itemId): bool
    {
        $call = $this->executeQuery('entity.item.delete', [
            'ENTITY' => $this->entityName,
            'ID' => $itemId,
        ]);

        if (empty($call)) {
            throw new \Exception('Error delete item: ' . $itemId);
        }

        return true;
    }
}