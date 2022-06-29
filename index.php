<?php

require_once __DIR__ . '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Core\Application;
use App\Core\Config;
// use App\Core\Router;
// use App\Container\Container;

// $constainer = new Container();
$app = new Application(new Config($_ENV));
$app->router->get('/', [App\Controllers\HomeController::class, 'index']);
$app->router->post('/', [App\Controllers\HomeController::class, 'testpost']);
$app->run();

/**
 * register all routes
 */

// $router = new Router($constainer);
// $router->get('/', [App\Controllers\HomeController::class, 'index']);
// $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

