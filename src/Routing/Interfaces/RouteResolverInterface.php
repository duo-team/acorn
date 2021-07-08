<?php

namespace DuoTeam\Acorn\Routing\Interfaces;

interface RouteResolverInterface
{
    /**
     * Resolve routes routes.
     *
     * @return void
     */
    public function resolveRoutes(): void;
}