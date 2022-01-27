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
    private Response $response;

    /**
     * Sets parameters of an object
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param string $path
     * @param mixed $callback
     * @return void
     */
    public function get(string $path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param string $path
     * @param mixed $callback
     * @return void
     */
    public function post(string $path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback);
    }

    public function renderView(string $view, array $params = []): string
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    private function layoutContent(): string
    {
        ob_start();
        include_once Application::$ROOT_DIR . '/views/layouts/main.php';
        return ob_get_clean();
    }

    /**
     * @param string $view
     * @return string
     */
    private function renderOnlyView(string $view, array $params): string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
