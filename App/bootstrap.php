<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'Core/Autoloader/ClassLoader.php';
$autoloader = new \App\Core\Autoloader\ClassLoader(null, '..');
$autoloader->register();

$dic = new \App\DI\DIContainer();

$router = $dic->getRouter();
$routeFile = $dic->getConfigFilePath("main.routes");


$router->setRouteFile($routeFile);
$router->initialize();

$router->handle($_SERVER['REQUEST_URI']);