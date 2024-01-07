<?php

namespace App\Command;

use App\Enum\MovieTypeEnum;
use App\Manager\HistoryManager;
use App\Manager\MovieManager;
use App\Service\Api\Connector\TmdbApiConnector;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:set-daily-movie')]
class SetDailyMovieCommand extends Command
{
    public function __construct(
        private readonly MovieManager $movieManager,
        private readonly HistoryManager $historyManager
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ([MovieTypeEnum::TOP_RATED->value, MovieTypeEnum::TRENDING->value] as $type) {
            $movie = $this->movieManager->selectDailyMovie($type);
            $this->historyManager->createHistory($type, $movie);
            $this->movieManager->selectMovie($movie);
        }

        return Command::SUCCESS;
    }
}
