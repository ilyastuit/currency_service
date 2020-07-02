<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$config = require 'config.php';

$routes->add('auth', new Routing\Route('/auth', [
    '_controller' => [new \App\Controller\SiteController($config['db']['connection']), 'auth'],
]));

$routes->add('index', new Routing\Route('/{name}', [
    'name' => null,
    '_controller' => [new \App\Controller\SiteController($config['db']['connection']), 'index'],
]));

return $routes;