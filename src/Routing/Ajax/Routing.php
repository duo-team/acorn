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
}