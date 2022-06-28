<?php

require_once __DIR__ . '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Core\Application;
use App\Core\Config;
use App\Core\Router;

new Application(new Config($_ENV));



/**
 * register all routes
 */
$router = new Router();

$router->get('/', [App\Controllers\HomeController::class, 'index']);
$router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

