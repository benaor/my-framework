<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//Install autolader
require __DIR__ . '/vendor/autoload.php';

//Call request composant
$request = Request::createFromGlobals();

$name = $request->query->get("name", "world");

$response = new Response(); 
$response->headers->set('content-type', 'text/html; charset=utf-8');
$response->setContent(sprintf("Hello %s", htmlspecialchars($name, ENT_QUOTES)));

$response->send();
