<?php

require_once __DIR__ . '/app/bootstrap.php';

/**
 * catch exception that may not anywhere
 */
set_exception_handler(['App\Core\Exceptions\GlobalExceptionHandler', 'handle']);

/**
 * set api request/response header
 */
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/**
 * load the dotenv file
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Core\Application;
use App\Core\Config;

$app = new Application(new Config($_ENV));

/**
 * set router for the api gateway
 */
$app->router->get('/', [App\Controllers\HomeController::class, 'index']);
$app->router->post('/', [App\Controllers\HomeController::class, 'testpost']);

$app->run();