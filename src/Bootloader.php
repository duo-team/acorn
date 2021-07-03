<?php

namespace DuoTeam\Acorn;

use DuoTeam\Acorn\Bootstrap\ApplyFilters;
use DuoTeam\Acorn\Bootstrap\CaptureRequest;
use Roots\Acorn\Bootloader as Kernel;

class Bootloader extends Kernel
{
    /**
     * Get the list of application bootstraps
     *
     * @return string[]
     */
    protected function bootstrap(): array
    {
        return apply_filters('acorn/bootstrap', array_merge(parent::bootstrap(), [
            ApplyFilters::class,
            CaptureRequest::class,
        ]));
    }
}
