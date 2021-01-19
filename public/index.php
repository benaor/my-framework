<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

require __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

$routes = require __DIR__ . "/../src/routes.php";

//Create context
$context = new RequestContext();
$context->fromRequest($request);

//Create UrlMatcher
$urlMatcher = new UrlMatcher($routes, $context);

try {
    $resultat  = ($urlMatcher->match($request->getPathInfo()));
    $request->attributes->add($resultat);

    $className  = substr($resultat['_controller'], 0, strpos($resultat['_controller'], '@')); 
    $methodName = substr($resultat['_controller'], strpos($resultat['_controller'], '@') +1); 
    $controller = [new $className, $methodName];

    $response = call_user_func($controller, $request); 
} catch (ResourceNotFoundException $e) {
    $response = new Response("404 NOT FOUND", 404);
} catch (Exception $e) {
    $response = new Response("Une erreur est survenue", 500);
}

//Send the response
$response->send();
