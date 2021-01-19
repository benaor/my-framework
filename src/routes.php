<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

//Create route
$routes = new RouteCollection; 
$routes->add("hello", new Route('/hello/{name}', ['name' => 'world'] ));
$routes->add("bye", new Route('/bye'));
$routes->add("about", new Route('/about'));

return $routes;