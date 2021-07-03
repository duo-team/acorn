<?php

namespace DuoTeam\Acorn\Bootstrap;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class CaptureRequest
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
        $app->instance('request', Request::capture());
    }
}
