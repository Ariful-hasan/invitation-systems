<?php

namespace App\Core;

use App\Core\DB;
use PDO;
use App\Contracts\ConfigContract;
use App\Core\Container;
use App\Core\Router;
use App\Core\Request;
use App\Core\Response;


use App\Controllers\TestController;//test
use App\Controllers\TestInterface;//test

class Application {

    private static PDO $db;
    private Container $container;
    public Router $router;
    public Request $request;
    public Response $response;


    public function __construct(protected ConfigContract $config)
    {
        self::$db = DB::connect($config->db[0]);

        $this->container = new Container();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->container, $this->request, $this->response);

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
        try {
            $this->router->resolve();
        } catch (\Exception $e) {
            return $this->response->send(500, "Internal server error");
        }
    }
}