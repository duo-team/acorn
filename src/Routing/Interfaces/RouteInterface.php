<?php

namespace DuoTeam\Acorn\Routing\Interfaces;

interface RouteInterface
{
    /**
     * Get route handler.
     *
     * @return callable
     */
    public function getHandler(): callable;

    /**
     * Get allowed methods.
     *
     * @return array
     */
    public function getMethods(): array;
}