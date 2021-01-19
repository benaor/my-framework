<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


class GreetingController {
    public function hello(Request $request)
    {
        $name = $request->attributes->get('name');
        ob_start(); 
        include __DIR__ . '/pages/hello.php';
        return new Response(ob_get_clean());
    }    
}
//Create route
$routes = new RouteCollection; 
$routes->add("hello", new Route('/hello/{name}', [
    'name' => 'world',
    '_controller' => [new GreetingController, 'hello']
    ] ));
$routes->add("bye", new Route('/bye'));
$routes->add("about", new Route('/about'));

return $routes;