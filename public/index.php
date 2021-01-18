<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

require __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();
$response = new Response();

//Create route
$routes = new RouteCollection; 
$routes->add("hello", new Route('/hello/{name}', ['name' => 'world'] ));
$routes->add("bye", new Route('/bye'));
$routes->add("about", new Route('/about'));

//Create context
$context = new RequestContext();
$context->fromRequest($request);

//Create UrlMatcher
$urlMatcher = new UrlMatcher($routes, $context);

$pathInfo = $request->getPathInfo();
try {
    extract($urlMatcher->match($pathInfo));
    
    ob_start();
    include __DIR__ . '/../src/pages/' . $resultat['_route']. ".php";
    $response->setContent(ob_get_clean());

} catch (ResourceNotFoundException $e) {
    $response->setContent("404 NOT FOUND");
    $response->setStatusCode(404);
}

//Send the response
$response->send();