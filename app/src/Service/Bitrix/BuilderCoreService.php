<?php 

namespace App\Service\Bitrix;

use App\{
    Entity\Client,
    Service\Bitrix\ClientManagerService,
    EventListener\Bitrix\AuthTokenListener
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
use Monolog\{
    Handler\StreamHandler,
    Logger
};
use Symfony\Component\{
    EventDispatcher\EventDispatcher,
    HttpClient\HttpClient,
    HttpClient\TraceableHttpClient
};

class BuilderCoreService
{
    private ClientManagerService $clientManagerService;
    private Logger $logger;

    public function __construct(ClientManagerService $clientManagerService)
    {
        $this->clientManagerService = $clientManagerService;
        $this->logger = new Logger('bitrix24', [new StreamHandler('b24-api-client.log', Logger::INFO)]);
    }

    public function getLogger(): Logger
    {
        return $this->logger;
    }

    public function getCore(string $memberId): CoreInterface
    {
        $client = $this->clientManagerService->get($memberId);
        $apiClient = $this->createApiClient($client);

        $apiLevelErrorHandler = new ApiLevelErrorHandler($this->logger);
        $eventDispatcher = new EventDispatcher();
        $eventDispatcher->addListener(\Bitrix24\SDK\Events\AuthTokenRenewedEvent::class, [new AuthTokenListener($this->clientManagerService), 'onAuthTokenRenewed']);
        
        return new Core($apiClient, $apiLevelErrorHandler, $eventDispatcher, $this->logger);
    }

    private function createApiClient(Client $client): ApiClient
    {
        $credentials = $this->getCredentials($client);
        $traceableClient = $this->getTraceableClient();

        return new ApiClient($credentials, $traceableClient, $this->logger);
    }

    private function getCredentials(Client $client): Credentials
    {
        return Credentials::createFromOAuth($this->createAccessToken($client), $this->getAppProfile(), 'https://' . $client->getDomain() . '/');
    }

    private function getTraceableClient(): TraceableHttpClient
    {
        $traceableClient = new TraceableHttpClient(HttpClient::create(['http_version' => '2.0']));
        $traceableClient->setLogger($this->logger);

        return $traceableClient;
    }

    private function createAccessToken(Client $client): AccessToken
    {
        return new AccessToken(
            $client->getAccessToken(),
            $client->getRefreshToken(),
            $client->getExpires(),
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