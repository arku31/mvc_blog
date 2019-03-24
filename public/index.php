<?php
define('ROOT_PATH', __DIR__.'/../');
require __DIR__ . '/../src/Core/Loader.php';
require __DIR__.'/../src/helpers.php';

$loader = new \App\Core\Loader();
$loader->initRouter(new \App\Core\Router());
$loader->fireAction();


