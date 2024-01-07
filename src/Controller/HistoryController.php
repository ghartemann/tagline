<?php

namespace App\Controller;

use App\Manager\HistoryManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/history', name: 'history_')]
class HistoryController extends AbstractController
{
    #[Route('/newest/{type}', name: 'newest')]
    public function getNewest(string $type, HistoryManager $historyManager): JsonResponse
    {
        return $this->json($historyManager->getNewest($type), 200, [], ['groups' => ['front']]);
    }

    #[Route('/verify/{type}/{id}', name: 'verify')]
    public function verify(string $type, int $id, HistoryManager $historyManager): JsonResponse
    {
        return new JsonResponse($historyManager->getNewest($type)->getMovie()->getTmdbId() === $id);
    }
}
