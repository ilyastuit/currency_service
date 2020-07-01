<?php

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$name = $request->get('name', 'World');

$response = new Response(
    sprintf('Hello %s', htmlspecialchars($name))
);

$response->send();