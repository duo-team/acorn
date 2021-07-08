<?php

namespace DuoTeam\Acorn\Routing\Ajax;

use DuoTeam\Acorn\Routing\RoutesCollection;
use Illuminate\Http\Request;

class Router
{
    /**
     * Routes to load in application.
     *
     * @var RoutesCollection
     */
    protected $routes;

    /**
     * @param RoutesCollection $routes
     */
    public function __construct(RoutesCollection $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Add GET ajax route.
     *
     * @param string $action
     * @param callable $handler
     * @param bool $isPublic
     *
     * @return Route
     */
    public function get(string $action, callable $handler, bool $isPublic = true): Route
    {
        $route = new Route([Request::METHOD_GET, Request::METHOD_HEAD], $action, $handler, $isPublic);
        $this->routes->add($route);

        return $route;
    }

    /**
     * Get all router routes.
     *
     * @return Route[]
     */
    public function routes(): array
    {
        return $this->routes->all();
    }
}