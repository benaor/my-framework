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
    extract($urlMatcher->match($request->getPathInfo()));
    ob_start();
    include __DIR__ . '/../src/pages/' . $_route . ".php";
    $response = new Response(ob_get_clean());

} catch (ResourceNotFoundException $e) {
    $response = new Response("404 NOT FOUND", 404);
} catch (Exception $e) {
    $response = new Response("Une erreur est survenue", 500);
}

//Send the response
$response->send();