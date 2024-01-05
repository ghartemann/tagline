<?php

namespace App\Manager;

use App\Entity\Movie;
use App\Service\Api\Connector\TmdbApiConnector;
use Doctrine\ORM\EntityManagerInterface;

class MovieManager extends AbstractManager
{
    public function __construct(
        private readonly TmdbApiConnector $tmdbApiConnector,
        EntityManagerInterface $em
    )
    {
        parent::__construct($em);
    }

    public function getRandomTagline(): string
    {
        $movies = $this->findAll();
        $movies = array_filter($movies, fn(Movie $movie) => $movie->getTagline() !== null && $movie->getTagline() !== '');
        $randomMovie = $movies[array_rand($movies)];

        return $randomMovie->getTagline();
    }

    public function searchMovies(string $query): array
    {
        $movies = $this->tmdbApiConnector->searchMovies($query);

        return $movies['results'];
    }
}
