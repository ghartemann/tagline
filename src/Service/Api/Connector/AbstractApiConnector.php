<?php


namespace App\Service\Api\Connector;


use Exception;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Throwable;

class AbstractApiConnector
{
    public function __construct(
        protected readonly string            $url,
        private readonly string              $apiKey,
        private readonly HttpClientInterface $client,
        private readonly string              $headerApi = 'X-API-KEY'
    )
    {
    }

    public function query(
        string $uri,
        string $method = 'GET',
        array $data = [],
        array $metadata = []
    ): ResponseInterface
    {
        if (str_starts_with($uri, 'http')) {
            $url = $uri;
        } else {
            $url = $this->url . $uri;
        }

        try {
            $response = $this->client->request(
                $method,
                $url,
                [
                    'json' => $data,
                    'user_data' => $metadata,
                    'timeout' => 60,
                    'headers' => [
                        $this->headerApi => $this->apiKey,
                    ]
                ]
            );
        } catch (TransportExceptionInterface $e) {
            throw new Exception($e->getMessage(), 500, $e);
        }

        return $response;
    }

    public function getContentAsArray(ResponseInterface $response): array
    {
        try {
            return $response->toArray();
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), 500, $e);
        }
    }
}
