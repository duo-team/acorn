<?php

namespace DuoTeam\Acorn\Foundation;

use DuoTeam\Acorn\Bootstrap\ApplyFilters;
use DuoTeam\Acorn\Bootstrap\HandleExceptions;
use DuoTeam\Acorn\Bootstrap\CaptureRequest;
use DuoTeam\Acorn\Bootstrap\RegisterCustomPostTypes;
use Roots\Acorn\Bootloader as RootsKernel;
use Roots\Acorn\Bootstrap\RegisterGlobals;

class Kernel extends RootsKernel
{
    /**
     * Get the list of application bootstraps
     *
     * @return string[]
     */
    protected function bootstrap(): array
    {
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
            HandleExceptions::class,
            ApplyFilters::class,
            RegisterCustomPostTypes::class
        ]);
    }
}
