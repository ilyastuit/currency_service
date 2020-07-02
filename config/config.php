<?php

$db = require 'db.php';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$config = [
    'db' => [
        'connection' => new \PDO($db['dsn'], $db['user'], $db['pass'], [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]),
    ]
];

return $config;