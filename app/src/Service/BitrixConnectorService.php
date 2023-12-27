<?php

declare(strict_types=1);
namespace App\Service;

use App\{
    Entity\Bitrix,
    Repository\BitrixRepository,
    EventListener\Bitrix\AuthTokenListener
};

use Monolog\{
    Handler\StreamHandler,
    Logger
};

use Symfony\Component\{
    EventDispatcher\EventDispatcher,
    HttpClient\HttpClient,
    HttpClient\TraceableHttpClient
};

use Bitrix24\SDK\Core\{
    Core,
    ApiClient,
    ApiLevelErrorHandler,
    Contracts\CoreInterface,
    Credentials\AccessToken,
    Credentials\ApplicationProfile,
    Credentials\Credentials,
    Credentials\Scope
};

class BitrixConnectorService
{
    private Logger $logger;

    public function __construct(private BitrixRepository $manager)
    {
        $this->manager = $manager;
        $this->logger = new Logger('bitrix24', [new StreamHandler('b24-api-client.log', Logger::INFO)]);
    }

    public function getLogger(): Logger
    {
        return $this->logger;
    }

    public function getCore(string $memberId): CoreInterface
    {
        $entity = $this->manager->get($memberId);
        $apiClient = $this->createApiClient($entity);

        $apiLevelErrorHandler = new ApiLevelErrorHandler($this->logger);
        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(\Bitrix24\SDK\Events\AuthTokenRenewedEvent::class, [new AuthTokenListener($this->manager), 'onAuthTokenRenewed']);

        return new Core($apiClient, $apiLevelErrorHandler, $eventDispatcher, $this->logger);
    }

    private function createApiClient(Bitrix $entity): ApiClient
    {
        $credentials = $this->getCredentials($entity);
        $traceableClient = $this->getTraceableClient();

        return new ApiClient($credentials, $traceableClient, $this->logger);
    }

    private function getCredentials(Bitrix $entity): Credentials
    {
        return Credentials::createFromOAuth($this->createAccessToken($entity), $this->getAppProfile(), 'https://' . $entity->getDomainUrl() . '/');
    }

    private function getTraceableClient(): TraceableHttpClient
    {
        $traceableClient = new TraceableHttpClient(HttpClient::create(['http_version' => '2.0']));
        $traceableClient->setLogger($this->logger);

        return $traceableClient;
    }

    private function createAccessToken(Bitrix $entity): AccessToken
    {
        return new AccessToken(
            $entity->getAccessToken(),
            $entity->getRefreshToken(),
            $entity->getExpiresOn(),
        );
    }

    private function getAppProfile(): ApplicationProfile
    {
        return new ApplicationProfile(
            $_ENV['BITRIX24_CLIENT_ID'],
            $_ENV['BITRIX24_CLIENT_SECRET'],
            new Scope(
                explode(',', $_ENV['BITRIX24_SCOPE'])
            )
        );
    }
}