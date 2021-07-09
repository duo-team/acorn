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
     * @param callable|string $handler
     *
     * @return Route
     */
    public function get(string $action, $handler): Route
    {
        $route = new Route([Request::METHOD_GET, Request::METHOD_HEAD], $action, $handler);
        $this->routes->add($route);

        return $route;
    }

    /**
     * Add POST Ajax route.
     *
     * @param string $action
     * @param callable|string $handler
     *
     * @return Route
     */
    public function post(string $action, $handler): Route
    {
        $route = new Route([Request::METHOD_POST], $action, $handler);
        $this->routes->add($route);

        return $route;
    }

    /**
     * Add POST Ajax route.
     *
     * @param string $action
     * @param callable|string $handler
     *
     * @return Route
     */
    public function put(string $action, $handler): Route
    {
        $route = new Route([Request::METHOD_PUT], $action, $handler);
        $this->routes->add($route);

        return $route;
    }

    /**
     * Add POST Ajax route.
     *
     * @param string $action
     * @param callable|string $handler
     *
     * @return Route
     */
    public function delete(string $action, $handler): Route
    {
        $route = new Route([Request::METHOD_DELETE], $action, $handler);
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