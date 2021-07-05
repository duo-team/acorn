<?php

namespace DuoTeam\Acorn\Foundation;

use DuoTeam\Acorn\Bootstrap\ApplyFilters;
use DuoTeam\Acorn\Bootstrap\CaptureRequest;
use Roots\Acorn\Bootloader as RootsKernel;

class Kernel extends RootsKernel
{
    /**
     * Get the list of application bootstraps
     *
     * @return string[]
     */
    protected function bootstrap(): array
    {
        return apply_filters('acorn/bootstrap', array_merge([
            CaptureRequest::class,
        ], parent::bootstrap(), [
            ApplyFilters::class,
        ]));
    }
}
