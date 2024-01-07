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
        $result = $historyManager->getNewest($type)->getMovie()->getTmdbId() === $id;

        if ($result === true) {
            $historyManager->getNewest($type)->setNbWinners($historyManager->getNewest($type)->getNbWinners() + 1);
            $historyManager->persist($historyManager->getNewest($type), true);
        }

        return new JsonResponse($result);
    }
}
