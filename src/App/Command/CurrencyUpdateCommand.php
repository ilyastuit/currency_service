<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CurrencyUpdateCommand extends Command
{
    protected static $defaultName = 'currency:update';

    protected function configure()
    {
        $this
            ->setDescription('Update currencies.')
            ->setHelp('This command allows you to update currencies...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Currency Updater',
            '================',
            '',
        ]);

        $output->writeln('Whoa!');

        $output->write('You are about to ');
        $output->writeln('update currencies.');
        return Command::SUCCESS;
    }
}