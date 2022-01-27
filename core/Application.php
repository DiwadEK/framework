<?php

declare(strict_types=1);

namespace app\core;

/**
 * @package app\core
 */
class Application
{
    public Router $router;
    public Request $request;

    /**
     * Sets parameters of an object
     *
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
