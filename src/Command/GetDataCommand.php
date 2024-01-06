<?php

namespace App\Command;

use App\Entity\Movie;
use App\Enum\MovieTypeEnum;
use App\Manager\MovieManager;
use App\Service\Api\Connector\TmdbApiConnector;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:get-data')]
class GetDataCommand extends Command
{
    public function __construct(
        private readonly TmdbApiConnector $tmdbApiConnector,
        private readonly MovieManager $movieManager
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $trending = $this->tmdbApiConnector->getTrending()['results'];

        $topRated = [];
        for ($i = 1; $i <= 5; $i++) {
            $topRated = array_merge($topRated, $this->tmdbApiConnector->getTopRated($i)['results']);
        }

        $progressBar = new ProgressBar($output, count($trending) + count($topRated));
        $progressBar->start();

        foreach ($trending as $movie) {
            $this->createOrUpdate($movie, MovieTypeEnum::TRENDING->value);

            $progressBar->advance();
        }

        foreach ($topRated as $movie) {
            $this->createOrUpdate($movie, MovieTypeEnum::TOP_RATED->value);

            $progressBar->advance();
        }

        return Command::SUCCESS;
    }

    protected function createOrUpdate($movie, $movieType): void
    {
        $details = $this->tmdbApiConnector->getDetails($movie['id']);
        $detailsFr = $this->tmdbApiConnector->getDetailsFr($movie['id']);

        $mov = $this->movieManager->findOneBy(['tmdbId' => $movie['id']]) ?? new Movie();
        $mov->setTitle($movie['title']);
        $mov->setTitleFr($detailsFr['title']);
        $mov->setReleaseDate(new \DateTime($movie['release_date']));
        $mov->setCover($movie['poster_path']);
        $mov->setTagline($details['tagline']);
        $mov->setTaglineFr($detailsFr['tagline']);
        $mov->setTmdbId($movie['id']);
        $mov->setType($movieType);

        $this->movieManager->persist($mov, true);
    }
}
