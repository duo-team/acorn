<?php

namespace DuoTeam\Acorn\Routing\Providers;

use DuoTeam\Acorn\Routing\Interfaces\RouteResolverInterface;
use DuoTeam\Acorn\Routing\Interfaces\RoutingInterface;
use Roots\Acorn\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Available routing's in application.
     *
     * @var string[]
     */
    protected $routing = [];

    /**
     * Available routing's resolvers.
     *
     * @var array
     */
    protected $resolvers = [];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRoutes();
        $this->resolveRoutes();
    }

    /**
     * Register routes in application.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        foreach ($this->routing as $routing) {
            $routing = $this->app->make($routing);

            if ($routing instanceof RoutingInterface) {
                $routing->registerRoutes();
            }
        }
    }

    /**
     * Resolve routes for routing's.
     *
     * @return void
     */
    protected function resolveRoutes(): void
    {
        foreach ($this->resolvers as $resolver) {
            $resolver = $this->app->make($resolver);

            if ($resolver instanceof RouteResolverInterface) {
                $resolver->resolveRoutes();
            }
        }
    }
}