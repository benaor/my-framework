<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GreetingController {
    public function hello(Request $request)
    {
        $name = $request->attributes->get('name');
        ob_start(); 
        include __DIR__ . '/pages/hello.php';
        return new Response(ob_get_clean());
    }    
}
