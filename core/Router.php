<?php

declare(strict_types=1);

namespace app\core;

/**
 * @package app\core
 */
class Router
{
    private array $routes = [];
    public Request $request;

    /**
     * Sets parameters of an object
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function get(string $path, \Closure $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            echo 'NOT FOUND';
            exit;
        }

        echo call_user_func($callback);
    }
}
