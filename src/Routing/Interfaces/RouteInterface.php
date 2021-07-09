<?php

namespace DuoTeam\Acorn\Routing\Interfaces;

interface RouteInterface
{
    /**
     * Get route handler.
     *
     * @return callable|string
     */
    public function getHandler();

    /**
     * Get allowed methods.
     *
     * @return array
     */
    public function getMethods(): array;
}