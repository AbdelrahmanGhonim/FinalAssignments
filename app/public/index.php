<?php

// try to start the session here  

require '../vendor/autoload.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new App\PatternRouter();
$router->route($uri);