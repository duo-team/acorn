<?php

namespace DuoTeam\Acorn\Bootstrap;

use DuoTeam\Acorn\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Roots\Acorn\Bootstrap\HandleExceptions as Bootstrap;
use Throwable;

class HandleExceptions extends Bootstrap
{
    /**
     * Bootstrap the given application.
     *
     * @param Application $app
     *
     * @return void
     */
    public function bootstrap(Application $app): void
    {
        parent::bootstrap($app);

        $app->singleton(
            ExceptionHandlerContract::class,
            Handler::class
        );
    }

    /**
     * Render an exception as an HTTP response and send it.
     *
     * @param Throwable $e
     * @return void
     */
    protected function renderHttpResponse(Throwable $e)
    {
        $this->getExceptionHandler()->render($this->app->make(Request::class), $e);
    }

    /**
     * Determine if a fatal error handler drop-in exists.
     *
     * @return bool
     */
    protected function hasHandler(): bool
    {
        return false;
    }

    /**
     * Determine if application debugging is enabled.
     *
     * @return bool
     */
    protected function isDebug(): bool
    {
        return true;
    }


}