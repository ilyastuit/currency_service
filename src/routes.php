<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('index', new Routing\Route('/{name}', [
    'name' => null,
    '_controller' => [new \App\Controllers\SiteController(), 'index'],
]));

return $routes;