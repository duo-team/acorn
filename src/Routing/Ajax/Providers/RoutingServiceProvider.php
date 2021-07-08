<?php

namespace DuoTeam\Acorn\Routing\Ajax\Providers;

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

    protected function registerMatchVerifierRules(): void
    {
        $this->app->singleton(RulesCollection::class);
    }
}