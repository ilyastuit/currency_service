<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$config = require 'config.php';

$routes->add('auth', new Routing\Route('/auth', [
    '_controller' => [new \App\Controller\SiteController($config['db']['connection']), 'auth'],
]));

$routes->add('index', new Routing\Route('/currencies/{page}', [
    'page' => 1,
    '_controller' => [new \App\Controller\SiteController($config['db']['connection']), 'index'],
]));

$routes->add('show', new Routing\Route('/currency/{id}', [
    'id' => null,
    '_controller' => [new \App\Controller\SiteController($config['db']['connection']), 'currency'],
]));

return $routes;