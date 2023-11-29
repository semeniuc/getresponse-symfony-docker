<?php

namespace App\Tests\Service;

use App\Service\ClientManagerService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class ClientManagerServiceTestPhpTest extends TestCase
{
    private $entityManager;
    private $clientManagerService;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->clientManagerService = new ClientManagerService($this->entityManager);
    }

    public function testSet()
    {
        $memberId = 'fc91abad728a1af85e86eff3d1e24654';
        $domain = 'test.bitrix24.com';
        $subscription = 'free';
        $keyAuth = '52a92f65005e29ad0055c8390000007df0f107342834c81fd37b49b2c4aeefa2fcf262';
        $keyRefresh = '42285765005e29ad0055c8390000007df0f107d128fa7284264187b7cf0294c62c8f2e';
        $appVersion = '3';

        $client = $this->clientManagerService->set($memberId, $domain, $subscription, $keyAuth, $keyRefresh, $appVersion);

        // Check if client was saved
        $this->assertInstanceOf(ClientManagerService::class, $client);

        // Check if client was saved with correct data
        $this->assertEquals($memberId, $client->getMemberId());
        $this->assertEquals($domain, $client->getDomain());
        $this->assertEquals($subscription, $client->getSubscription());
        $this->assertEquals($keyAuth, $client->getKeyAuth());
        $this->assertEquals($keyRefresh, $client->getKeyRefresh());
        $this->assertEquals($appVersion, $client->getAppVersion());
    }

    public function testGet()
    {
        $memberId = 'fc91abad728a1af85e86eff3d1e24654';

        $client = $this->createMock(ClientManagerService::class);

        $this->entityManager->expects($this->once())
            ->method('getRepository')
            ->willReturnSelf();

        $this->entityManager->expects($this->once())
            ->method('findOneBy')
            ->with(['memberId' => $memberId])
            ->willReturn($client);

        $resultClient = $this->clientManagerService->get($memberId);
        $this->assertSame($client, $resultClient);
    }
}