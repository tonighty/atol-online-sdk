<?php

namespace Majorov\AtolOnlineSdk;

use Majorov\AtolOnlineSdk\Exception\ApiClientErrorFactory;
use Majorov\AtolOnlineSdk\Exception\ExpiredTokenError;
use Majorov\AtolOnlineSdk\Exception\MissingTokenError;
use Majorov\AtolOnlineSdk\Exception\WrongLoginOrPasswordError;
use Majorov\AtolOnlineSdk\Model\OperationResponse;
use Majorov\AtolOnlineSdk\Model\ReceiptOperation;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Psr\SimpleCache\CacheInterface;

final class ApiClient
{
    private const SERVICE_URL = 'https://online.atol.ru/possystem/v4';
    private const TEST_SERVICE_URL = 'https://testonline.atol.ru/possystem/v4';

    private ?string $token = null;

    private ?CacheInterface $cache = null;
    private LoggerInterface $logger;

    private readonly ApiClientErrorFactory $apiErrorFactory;

    public function __construct(
        private readonly string                  $login,
        private readonly string                  $password,
        private readonly string                  $groupCode,
        private readonly bool                    $isTest,
        private readonly ClientInterface         $client,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly StreamFactoryInterface  $streamFactory,
    )
    {
        $this->apiErrorFactory = new ApiClientErrorFactory();
        $this->logger = new NullLogger();
    }

    public function sell(ReceiptOperation $operation): OperationResponse
    {
        $response = $this->sendAuthorizedRequest(
            'POST',
            "$this->groupCode/sell",
            $operation->toArray(),
        );

        return OperationResponse::fromArray($response);
    }

    protected function sendAuthorizedRequest(string $method, string $route, array $payload = []): array
    {
        $this->setupAuth();

        try {
            $response = $this->sendRequest($method, $route, $payload);
        } catch (WrongLoginOrPasswordError $exception) {
            $this->clearAuth();
            throw $exception;
        } catch (ExpiredTokenError|MissingTokenError) {
            $this->clearAuth();
            $this->setupAuth();
            $response = $this->sendRequest($method, $route, $payload);
        }

        return $response;
    }

    private function setupAuth(): void
    {
        if ($this->token === null) {
            $this->token = $this->getToken();
        }
    }

    private function getToken(): string
    {
        if ($this->cache?->has('token')) {
            return $this->cache->get('token');
        }

        $token = $this->sendRequest('GET', 'getToken', [
            'login' => $this->login,
            'pass' => $this->password,
        ])['token'];

        $this->cache?->set('token', $token, 1337);

        return $token;
    }

    private function sendRequest(string $method, string $route, array $payload = []): array
    {
        $uri = sprintf('%s/%s', $this->getServiceUrl(), $route);
        if ($method === 'GET') {
            $uri .= '?' . http_build_query($payload);
        }

        $body = $this->streamFactory->createStream(json_encode($payload));

        $request = $this->requestFactory
            ->createRequest($method, $uri)
            ->withHeader('Content-type', 'application/json; charset=utf-8')
            ->withHeader('Token', $this->token)
            ->withBody($body);

        $this->logRequest($request);

        $response = $this->client->sendRequest($request);

        $responseData = json_decode($response->getBody()->__toString(), true);
        if ($response->getStatusCode() !== 200 || isset($responseData['error'])) {
            $this->logger->error('Error response', $responseData);

            throw $this->apiErrorFactory->createException(
                $responseData['error']['code'] ?? null,
                $responseData['error']['text'] ?? null,
            );
        }

        $this->logResponse($response);

        return $responseData;
    }

    private function getServiceUrl(): string
    {
        return $this->isTest ? self::TEST_SERVICE_URL : self::SERVICE_URL;
    }

    private function logRequest(RequestInterface $request): void
    {
        $this->logger->debug('Request', [
            'url' => $request->getUri(),
            'headers' => $request->getHeaders(),
            'data' => $request->getBody()->__toString(),
        ]);
    }

    private function logResponse(ResponseInterface $response): void
    {
        $this->logger->debug('Response', [
            'headers' => $response->getHeaders(),
            'data' => $response->getBody()->__toString(),
        ]);
    }

    private function clearAuth(): void
    {
        $this->token = null;
    }

    public function setCache(?CacheInterface $cache): void
    {
        $this->cache = $cache;
    }

    public function setLogger(?LoggerInterface $logger): void
    {
        $this->logger = $logger ?? new NullLogger();
    }
}
