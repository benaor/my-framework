<?php

$name = isset($_GET["name"]) ? $_GET["name"] : "world";

header('content-type: text/html; charset=utf-8');

printf("Hello %s", htmlspecialchars($name, ENT_QUOTES));