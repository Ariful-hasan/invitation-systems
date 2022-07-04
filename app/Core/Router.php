<?php

namespace App\Core;

use Exception;
use App\Core\Container;
// use App\Core\Request;
// use App\Core\Response;
use App\Core\Contracts\RequestContract;
use App\Core\Contracts\ResponseContract;

/**
 * Need time to perfectly workable
 */
class Router {

    private array $routes;

    public function __construct(private Container $container, private RequestContract $request, private ResponseContract $response)
    {
        # code...
    }
    
    /**
     * register
     *
     * @param  mixed $requestMethod
     * @param  mixed $route
     * @param  mixed $action
     * @return self
     */
    public function register(string $requestMethod, string $route, callable | array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }
    
    /**
     * get
     *
     * @param  mixed $route
     * @param  mixed $action
     * @return self
     */
    public function get(string $route, callable | array $action): self
    {
        return $this->register('get',$route, $action);
    }
    
    /**
     * post
     *
     * @param  mixed $route
     * @param  mixed $action
     * @return self
     */
    public function post(string $route, callable | array $action): self
    {
        return $this->register('post',$route, $action);
    }
    
    /**
     * put
     *
     * @param  mixed $route
     * @param  mixed $action
     * @return self
     */
    public function put(string $route, callable | array $action): self
    {
        return $this->register('put',$route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }
    
    /**
     * resolve
     *
     * @param  mixed $requestUri
     * @param  mixed $requestMethod
     * @return void
     * 
     * need time to perfectly workable
     */
    public function resolve()
    { 
        $route = $this->request->getUrl();
        $action = $this->routes[$this->request->getMethod()][$route] ?? null;

        if (!$action) {
            throw new Exception("404 not found!");
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $method] = $action;

            if (class_exists($class)) {
                // $class = new $class();
                $class = $this->container->get($class);

                if (method_exists($class, $method)) {
                    
                    return call_user_func_array([$class, $method], [$this->request, $this->response]);
                }
            }
        }

        throw new Exception("404 not found!");
    }
}