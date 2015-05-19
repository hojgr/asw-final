<?php

include 'Core/Autoloader/ClassLoader.php';
$autoloader = new \App\Core\Autoloader\ClassLoader(null, '..');
$autoloader->register();

session_start();

$dic = new \App\DI\DIContainer();

$dic->getRuntime()->initialize($dic->getConfigFilePath("main.routes"));