<?php

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use App\Command\CurrencyUpdateCommand;
use Symfony\Component\Console\Application;
$config = require 'config/config.php';

$application = new Application();

$application->add(new CurrencyUpdateCommand($config['db']['connection']));

$application->run();
