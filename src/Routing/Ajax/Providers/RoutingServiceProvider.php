<?php

namespace DuoTeam\Acorn\Routing\Ajax\Providers;

use DuoTeam\Acorn\Routing\Ajax\Match\Rules\HttpMethodMatchRule;
use DuoTeam\Acorn\Routing\Ajax\Match\RulesCollection;
use DuoTeam\Acorn\Routing\Ajax\Router;
use Roots\Acorn\ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Router::class);

        $this->registerMatchVerifierRules();
    }

    /**
     * Register match verifier rules.
     *
     * @return void
     */
    protected function registerMatchVerifierRules(): void
    {
        $this->app->singleton(RulesCollection::class);

        $this->app->get(RulesCollection::class)
            ->add($this->app->make(HttpMethodMatchRule::class));
    }
}