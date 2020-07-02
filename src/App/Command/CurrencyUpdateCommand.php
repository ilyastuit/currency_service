<?php

namespace App\Command;

use App\Model\Currency;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CurrencyUpdateCommand extends Command
{
    protected static $defaultName = 'currency:update';
    private $pdo;

    public function __construct(\PDO $pdo, string $name = null)
    {
        parent::__construct($name);
        $this->pdo = $pdo;
    }

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
        $currency = new Currency($this->pdo);

        if ($currency->updateCurrency()) {
            $output->writeln('Something went wrong.');
        } else {
            $output->writeln('Whoa!');
            $output->writeln('Currencies updated.');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}