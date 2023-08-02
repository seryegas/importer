<?php

namespace App\Command;

use App\Factories\DatabaseClientFactory;
use App\Factories\DataProviderFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCommand extends Command
{
    protected static $defaultName = 'ImportCommand';
    protected static $defaultDescription = 'Importing data from file into database client';

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output = new SymfonyStyle($input, $output);

        $dataProvider = DataProviderFactory::create();
        $databaseClient = DatabaseClientFactory::create($input->getArgument('database'));

        foreach ($dataProvider->readFileData($input->getArgument('filepath')) as $object) {
            $databaseClient->store($object);
        }

        $output->success('writed succesfully');

        return Command::SUCCESS;
    }
}
