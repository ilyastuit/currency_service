<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('auth', new Routing\Route('/auth', [
    'name' => null,
    '_controller' => [new \App\Controller\SiteController(), 'auth'],
]));

$routes->add('index', new Routing\Route('/{name}', [
    'name' => null,
    '_controller' => [new \App\Controller\SiteController(), 'index'],
]));

return $routes;