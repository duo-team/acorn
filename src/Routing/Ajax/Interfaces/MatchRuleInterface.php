<?php

namespace DuoTeam\Acorn\Routing\Ajax\Interfaces;

use DuoTeam\Acorn\Routing\Ajax\Route;

interface MatchRuleInterface
{
    /**
     * Verify route match.
     *
     * @param Route $route
     *
     * @return void
     */
    public function verify(Route $route): void;
}