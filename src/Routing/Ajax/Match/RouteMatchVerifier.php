<?php

namespace DuoTeam\Acorn\Routing\Ajax\Match;

use DuoTeam\Acorn\Routing\Ajax\Route;

class RouteMatchVerifier
{
    /**
     * Rules collection.
     *
     * @var RulesCollection
     */
    protected $rules;

    /**
     * @param RulesCollection $rules
     */
    public function __construct(RulesCollection $rules)
    {
        $this->rules = $rules;
    }

    /**
     * Verify route against verifier rules.
     *
     * @param Route $route
     *
     * @return void
     */
    public function verifyRoute(Route $route): void
    {
        foreach ($this->rules->all() as $rule) {
            $rule->verify($route);
        }
    }
}