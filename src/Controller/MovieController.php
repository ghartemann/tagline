<?php

namespace App\Controller;

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
}
