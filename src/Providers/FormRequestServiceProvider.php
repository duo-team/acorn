<?php

namespace DuoTeam\Acorn\Providers;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use DuoTeam\Acorn\Http\FormRequest;
use Illuminate\Support\ServiceProvider;

class FormRequestServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->afterResolving(ValidatesWhenResolved::class, function ($resolved) {
            $resolved->validateResolved();
        });

        $this->app->resolving(FormRequest::class, function ($request, $app) {
            $request = FormRequest::createFrom($app['request'], $request);
            $request->setContainer($app);
        });
    }
}