<?php

namespace DuoTeam\Acorn\Providers;

use DuoTeam\Acorn\Http\Controller;
use DuoTeam\Acorn\Resources\Managers\ResourceTransformerManager;
use Roots\Acorn\ServiceProvider;
use function Roots\config_path;
use function Roots\resource_path;

class DuoTeamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publish();
        $this->mergeConfigs();
        $this->setControllerDependencies();
    }

    /**
     * Publish resources to application.
     *
     * @return void
     */
    protected function publish(): void
    {
        $this->publishes([
            sprintf('%s/config/acf.php', $this->packagePath()) => config_path('acf.php'),
            sprintf('%s/config/filters.php', $this->packagePath()) => config_path('filters.php'),
            sprintf('%s/config/database.php', $this->packagePath()) => config_path('database.php'),
        ], 'duo-team-config');

        $this->publishes([
            sprintf('%s/resources/acf', $this->packagePath()) => resource_path('acf'),
        ], 'duo-team-resources');
    }

    /**
     * Merge config from package to application.
     *
     * @return void
     */
    protected function mergeConfigs(): void
    {
        $this->mergeConfigFrom(sprintf('%s/config/acf.php', $this->packagePath()), 'acf');
        $this->mergeConfigFrom(sprintf('%s/config/filters.php', $this->packagePath()), 'filters');
        $this->mergeConfigFrom(sprintf('%s/config/database.php', $this->packagePath()), 'database');
    }

    /**
     * Get package path.
     *
     * @return string
     */
    protected function packagePath(): string
    {
        return realpath(sprintf('%s/../../', __DIR__));
    }

    /**
     * Set controller dependencies.
     *
     * @return void
     */
    protected function setControllerDependencies(): void
    {
        $this->app->afterResolving(Controller::class, function (Controller $controller, $app) {
            $resourceTransformerManager = $app->make(ResourceTransformerManager::class);
            $controller->setResourceTransformerManager($resourceTransformerManager);
        });
    }
}