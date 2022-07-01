<?php

namespace App\Core;

use App\Core\DB;
use PDO;
use App\Core\Contracts\ConfigContract;
use App\Core\Container;
use App\Core\Router;
use App\Core\Request;
use App\Core\Response;

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
        // $this->container->set(RequestContract::class, Request::class);
    }

    public static function db(): PDO
    {
       return self::$db;
    }

    public function run()
    {
        try {
            $this->router->resolve();
        } catch (\Exception $e) {
            return $this->response->send(500, "Internal server error");
        }
    }
}