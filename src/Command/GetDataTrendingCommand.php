<?php

namespace App\Command;

use App\Enum\MovieTypeEnum;
use App\Manager\MovieManager;
use App\Service\Api\Connector\TmdbApiConnector;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:get-data:trending')]
class GetDataTrendingCommand extends Command
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

        $progressBar = new ProgressBar($output, count($trending));
        $progressBar->start();

        foreach ($trending as $movie) {
            $similar = $this->tmdbApiConnector->getSimilar($movie['id'])['results'];
            $this->movieManager->createOrUpdate($movie, $similar, MovieTypeEnum::TRENDING->value);

            $progressBar->advance();
        }

        return Command::SUCCESS;
    }
}
