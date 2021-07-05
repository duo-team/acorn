<?php

namespace DuoTeam\Acorn\Routing\Ajax;

use Illuminate\Http\Request;

class Router
{
    /**
     * Routes to load in application.
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Add GET ajax route.
     *
     * @param string $action
     * @param callable $handler
     *
     * @return Route
     */
    public function get(string $action, callable $handler): Route
    {
        $route = new Route([Request::METHOD_GET, Request::METHOD_HEAD], $action, $handler);
        $this->routes[] = $route;

        return $route;
    }

    /**
     * Get all router routes.
     *
     * @return Route[]
     */
    public function routes(): array
    {
        return $this->routes;
    }
}