<?php

namespace DuoTeam\Acorn\Database\Providers;

use DuoTeam\Acorn\Database\Connection;
use DuoTeam\Acorn\Database\ConnectionResolver;
use DuoTeam\Acorn\Database\Interfaces\ConnectionInterface;
use DuoTeam\Acorn\Database\Model;
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
        $this->app->bind(ConnectionInterface::class, Connection::class);
    }
}