<?php

namespace DuoTeam\Acorn\Database\Providers;

use Roots\Acorn\ServiceProvider;
use wpdb as WpDB;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->bindDatabase();
    }

    /**
     * Bind WordPress database to use it instead of global.
     *
     */
    protected function bindDatabase(): void
    {
        global $wpdb;

        $this->app->instance(WpDB::class, $wpdb);
    }
}