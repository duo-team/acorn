<?php

namespace DuoTeam\Acorn\Foundation;

use DuoTeam\Acorn\Bootstrap\ApplyFilters;
use DuoTeam\Acorn\Bootstrap\HandleExceptions;
use DuoTeam\Acorn\Bootstrap\CaptureRequest;
use DuoTeam\Acorn\Console\Kernel as ConsoleKernel;
use DuoTeam\Acorn\Exceptions\Handler;
use Roots\Acorn\Application;
use Roots\Acorn\Bootloader as RootsKernel;
use Illuminate\Contracts\Debug\ExceptionHandler as HandlerContract;
use Roots\Acorn\Bootstrap\RegisterGlobals;
use Roots\Acorn\Console\Kernel as RootsConsoleKernel;

class Kernel extends RootsKernel
{
    /**
     * Bindings to replace.
     *
     * @var string[]
     */
    protected $bindingsToReplace = [
        HandlerContract::class => Handler::class,
        RootsConsoleKernel::class => ConsoleKernel::class
    ];

    /**
     * Replace default bindings with DuoTeam.
     *
     * @return void
     */
    protected function replaceBindings(): void
    {
        $this->queue[] = function (Application $app) {
            foreach ($this->bindingsToReplace as $abstract => $concrete) {
                $app->singleton($abstract, $concrete);
            }
        };
    }

    /**
     * Get the list of application bootstraps
     *
     * @return string[]
     */
    protected function bootstrap(): array
    {
        $this->replaceBindings();
        return apply_filters('acorn/bootstrap', $this->bootstraps());
    }

    /**
     * Get bootstrapping classes.
     *
     * @return array
     */
    protected function bootstraps(): array
    {
        return array_merge([
            RegisterGlobals::class,
            CaptureRequest::class,
        ], parent::bootstrap(), [
            ApplyFilters::class,
            HandleExceptions::class
        ]);
    }
}
