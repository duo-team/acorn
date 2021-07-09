<?php

namespace DuoTeam\Acorn\Routing\Ajax;

use DuoTeam\Acorn\Routing\Interfaces\RoutingInterface;

abstract class Routing implements RoutingInterface
{
    /**
     * Ajax router instance.
     *
     * @var Router
     */
    protected $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Make at handler signature.
     *
     * @param string $class
     * @param string $method
     *
     * @return string
     */
    public function atHandler(string $class, string $method): string
    {
        return sprintf('%s@%s', $class, $method);
    }
}