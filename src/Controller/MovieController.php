<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Manager\HistoryManager;
use App\Manager\MovieManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie', name: 'movie_')]
class MovieController extends AbstractController
{
    #[Route('/tagline', name: 'tagline')]
    public function getTagline(MovieManager $movieManager): JsonResponse
    {
        return new JsonResponse($movieManager->getRandomTagline());
    }

    #[Route('/search/{query}', name: 'search')]
    public function search(string $query, MovieManager $movieManager): JsonResponse
    {
        return new JsonResponse($movieManager->searchMovies($query));
    }

    #[Route('/similar/{type}/{id}', name: 'similar')]
    public function isSimilar(string $type, int $id, HistoryManager $historyManager, MovieManager $movieManager): JsonResponse
    {
        $dailyIdMovie = $historyManager->getNewest($type)->getMovie()->getTmdbId();

        return new JsonResponse($movieManager->isSimilar($dailyIdMovie, $id));
    }
}
