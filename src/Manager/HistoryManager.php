<?php

namespace App\Manager;

use App\Entity\History;
use App\Entity\Movie;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class HistoryManager extends AbstractManager
{
    public function __construct(
        EntityManagerInterface $em
    )
    {
        parent::__construct($em);
    }

    public function createHistory(string $type, Movie $movie): void
    {
        $history = new History();

        $history->setDate(new DateTime());
        $history->setMovie($movie);
        $history->setType($type);

        $this->persist($history, true);
    }

    public function getNewest(string $type): History
    {
        return $this->findOneBy(['type' => $type], ['date' => 'DESC']);
    }
}
