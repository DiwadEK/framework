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


    public function get(string $path, mixed $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            return 'NOT FOUND';
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    private function renderView(string $view): void
    {
        include_once __DIR__ . "/../views/$view.php";
    }
}
