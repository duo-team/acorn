<?php

namespace DuoTeam\Acorn\Database\Providers;

use DuoTeam\Acorn\Database\WordPressDatabase;
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
        $this->bindWpDB();
    }

    /**
     * Bind WordPress database to use it instead of global.
     *
     */
    protected function bindWpDB(): void
    {
        global $wpdb;

        $this->app->instance(WpDB::class, $wpdb);
    }

}