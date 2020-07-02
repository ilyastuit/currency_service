<?php

require 'db.php';

$config = [
    'db' => [
        'connection' => new \PDO($db['dsn'], $db['user'], $db['pass'], [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]),
    ]
];