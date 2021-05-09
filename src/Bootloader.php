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
        return apply_filters('acorn/bootstrap', function () {
            return array_merge([
                \DuoTeam\Acorn\Bootstrap\ApplyFilters::class
            ], parent::bootstrap());
        });
    }
}
