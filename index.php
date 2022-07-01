<?php

error_reporting(1);

require_once __DIR__ . '/app/bootstrap.php';

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
$app->router->post('/user', [App\Http\Controllers\UserController::class, 'create']);
$app->router->post('/login', [App\Http\Controllers\AuthController::class, 'login']);
$app->router->post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

$app->run();


