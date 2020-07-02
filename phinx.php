<?php

$config = require 'config/db.php';
$db = require 'config/config.php';

return [
    'environments' =>  [
        'default_migration_table' => 'migrations',
        'default_database' => 'app',
        'app' => [
            'connection' => $config['db']['connection'],
            'adapter' => $db['adapter'],
            'host' => $db['host'],
            'name' => $db['name'],
            'user' =>  $db['user'],
            'pass'  =>  $db['pass'],
            'port' => $db['port'],
            'charset' => $db['charset'],
            'collation' => $db['collation'],
        ],
    ],
    'paths' => [
        'migrations' => 'db/migrations',
        'seeds' =>  'db/seeds',
    ],
];