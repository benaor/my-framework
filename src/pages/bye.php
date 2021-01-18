<?php

use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/vendor/autoload.php';

$response = new Response();
$response->setContent("Goodbye");
$response->send();