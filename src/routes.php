<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


//Create route
$routes = new RouteCollection; 
$routes->add("hello", new Route('/hello/{name}', [
    'name' => 'world',
    '_controller' => [new App\Controller\GreetingController, 'hello']
    ] ));
$routes->add("bye", new Route('/bye', [
    '_controller' => [new App\Controller\GreetingController, 'bye']
]));
$routes->add("about", new Route('/about'));

return $routes;