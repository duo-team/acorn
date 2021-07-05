<?php

namespace DuoTeam\Acorn\Providers;

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
        ], 'config');

        $this->publishes([
            sprintf('%s/resources/acf', $this->packagePath()) => resource_path('acf'),
        ], 'resource');
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
}