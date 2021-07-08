<?php

namespace DuoTeam\Acorn\Routing\Interfaces;

interface RoutingInterface
{
    /**
     * Register routing routes.
     *
     * @return void
     */
    public function registerRoutes(): void;
}