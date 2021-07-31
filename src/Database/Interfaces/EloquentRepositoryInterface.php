<?php


namespace DuoTeam\Acorn\Database\Interfaces;


use Illuminate\Database\Eloquent\Builder;

interface EloquentRepositoryInterface extends RepositoryInterface
{
    /**
     * Get eloquent builder.
     *
     * @return Builder
     */
    public function builder(): Builder;
}