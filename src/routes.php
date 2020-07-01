<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('index', new Routing\Route('/{name}', [
    'name' => null,
    '_controller' => [new \App\Controller\SiteController(), 'index'],
]));

return $routes;