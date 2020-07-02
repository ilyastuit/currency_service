<?php

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use App\Command\CurrencyUpdateCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new CurrencyUpdateCommand());

$application->run();
