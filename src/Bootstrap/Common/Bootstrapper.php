<?php

namespace DuoTeam\Acorn\Bootstrap\Common;

use DuoTeam\Acorn\Bootstrap\Exceptions\MissingBootstrapHandleMethodException;
use Illuminate\Contracts\Foundation\Application;

abstract class Bootstrapper
{
    /**
     * Handle method name.
     *
     * @var string
     */
    protected $handleMethod = 'handle';

    /**
     * Application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * Boostrap application.
     *
     * @param Application $app
     */
    public function bootstrap(Application $app): void
    {
        $this->app = $app;

        if (! method_exists($this, $this->handleMethod)) {
            throw MissingBootstrapHandleMethodException::byBootstrapper($this, $this->handleMethod);
        }

        $this->app->call([$this, $this->handleMethod]);
    }
}