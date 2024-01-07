<?php

namespace App\Manager;

use App\Entity\Movie;
use App\Service\Api\Connector\TmdbApiConnector;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class MovieManager extends AbstractManager
{
    public function __construct(
        private readonly TmdbApiConnector $tmdbApiConnector,
        EntityManagerInterface            $em
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

    public function selectDailyMovie(string $type): Movie
    {
        return $this->findBy(['type' => $type, 'displayed' => true], ['nbTimesSelected' => 'ASC'], 1)[0];
    }

    public function selectMovie(Movie $movie): void
    {
        $movie->setNbTimesSelected($movie->getNbTimesSelected() + 1);

        $this->persist($movie, true);
    }

    public function searchMovies(string $query): array
    {
        $movies = $this->tmdbApiConnector->searchMovies($query)['results'];
        $movies = array_filter($movies, fn($movie) => $movie['poster_path'] !== null && $movie['poster_path'] !== '' && $movie['release_date'] !== null && $movie['release_date'] !== '');

        return array_values($movies);
    }

    public function createOrUpdate(array $movie, string $movieType): void
    {
        $details = $this->tmdbApiConnector->getDetails($movie['id']);
        $detailsFr = $this->tmdbApiConnector->getDetailsFr($movie['id']);

        $oldMovie = $this->findOneBy(['tmdbId' => $movie['id']]);

        if ($oldMovie === null) {
            $mov = new Movie();

            $mov->setDisplayed(true);
            $mov->setNbTimesSelected(0);
        } else {
            $mov = $oldMovie;

            $mov->setDisplayed($mov->isDisplayed());
            $mov->setNbTimesSelected($mov->getNbTimesSelected());
        }

        $mov->setTitle($movie['title']);
        $mov->setTitleFr($detailsFr['title']);
        $mov->setReleaseDate(new DateTime($movie['release_date']));
        $mov->setCover($movie['poster_path']);
        $mov->setTagline($details['tagline']);
        $mov->setTaglineFr($detailsFr['tagline']);
        $mov->setTmdbId($movie['id']);
        $mov->setType($movieType);

        $this->persist($mov, true);
    }
}
