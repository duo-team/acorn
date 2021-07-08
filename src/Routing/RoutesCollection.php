<?php

namespace DuoTeam\Acorn\Routing;

use DuoTeam\Acorn\Routing\Interfaces\RouteInterface;

class RoutesCollection
{
    /**
     * Routes collection array.
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Add route to collection.
     *
     * @param RouteInterface $route
     *
     * @return void
     */
    public function add(RouteInterface $route): void
    {
        $this->routes[] = $route;
    }

    /**
     * Get all routes.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->routes;
    }
}