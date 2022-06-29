<?php

namespace App\Core;

use App\Core\DB;
use PDO;
use App\Core\ConfigInterface;
use App\Container\Container;
use App\Core\Router;
use App\Core\Request;


use App\Controllers\TestController;//test
use App\Controllers\TestInterface;//test

class Application {

    private static PDO $db;
    private Container $container;
    public Router $router;
    public Request $request;


    public function __construct(protected ConfigInterface $config)
    {
        self::$db = DB::connect($config->db[0]);

        $this->container = new Container();
        $this->request = new Request();
        $this->router = new Router($this->container, $this->request);

        /**
         * binding all the services.
         * interface dependencies.
         */
        $this->container->set(TestInterface::class, TestController::class);
    }

    public static function db(): PDO
    {
       return self::$db;
    }

    public function run()
    {
        // $this->router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
        $this->router->resolve();
    }
}