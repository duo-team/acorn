<?php

namespace DuoTeam\Acorn;

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
            \DuoTeam\Acorn\Bootstrap\ApplyFilters::class,
        ]));
    }
}
