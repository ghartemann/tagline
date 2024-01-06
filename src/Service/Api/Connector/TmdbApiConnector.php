<?php

namespace App\Service\Api\Connector;

use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class TmdbApiConnector
{
    public function __construct(
        private HttpClientInterface $client
    ) {}


    public function getTrending(): array
    {
        try {
            $response = $this->client->request(
                'GET',
                'https://api.themoviedb.org/3/trending/movie/week',
                [
                    'headers' => [
                        'accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $_ENV['API_BEARER'],
                    ]
                ]
            );

            return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getDetails(int $id): array
    {
        try {
            $response = $this->client->request(
                'GET',
                "https://api.themoviedb.org/3/movie/$id",
                [
                    'headers' => [
                        'accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $_ENV['API_BEARER'],
                    ]
                ]
            );

            return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getDetailsFr(int $id): array
    {
        try {
            $response = $this->client->request(
                'GET',
                "https://api.themoviedb.org/3/movie/$id?language=fr-FR",
                [
                    'headers' => [
                        'accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $_ENV['API_BEARER'],
                    ]
                ]
            );

            return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function searchMovies(string $query): array
    {
        try {
            $response = $this->client->request(
                'GET',
                "https://api.themoviedb.org/3/search/movie?query=$query&page=1&include_adult=false",
                [
                    'headers' => [
                        'accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $_ENV['API_BEARER'],
                    ]
                ]
            );

            return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getTopRated(int $page): array
    {
        try {
            $response = $this->client->request(
                'GET',
                "https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=$page&sort_by=vote_average.desc&without_genres=99,10755&vote_count.gte=200",
                [
                    'headers' => [
                        'accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $_ENV['API_BEARER'],
                    ]
                ]
            );

            return json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
