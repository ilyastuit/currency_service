<?php

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use App\Application;
use App\Event\SimpleListener;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;



$request = Request::createFromGlobals();
$routes = include 'config/routes.php';

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new SimpleListener());

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();
$request->attributes->add($matcher->match($request->getPathInfo()));

$controller = $controllerResolver->getController($request);
$arguments = $argumentResolver->getArguments($request, $controller);

$framework = new Application($dispatcher, $matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();