<?php

namespace DuoTeam\Acorn\Routing\Providers;

use DuoTeam\Acorn\Routing\Ajax\Router;
use Roots\Acorn\ServiceProvider;

class AjaxRoutingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Router::class);
    }
}