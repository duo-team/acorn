<?php

namespace DuoTeam\Acorn\Providers;

use Roots\Acorn\ServiceProvider;

class DuoTeamServiceProvider extends ServiceProvider
{
    /**
     * Config to pubslish.
     *
     * @var string[]
     */
    protected $config = [
        'acf',
        'filters'
    ];

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        dd($this->packagePath());

        $this->publishes([
            __DIR__.'/../config/courier.php' => config_path('courier.php'),
        ]);
    }

    private function packagePath(): string
    {
        return realpath(sprintf('%s/../../', __DIR__));
    }
}