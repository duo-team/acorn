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

    /**
     * Make at handler signature.
     *
     * @param string $class
     * @param string $method
     *
     * @return string
     */
    public function atHandler(string $class, string $method): string;
}