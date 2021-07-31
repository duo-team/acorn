<?php


namespace DuoTeam\Acorn\Database\Interfaces;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface extends RepositoryInterface
{
    /**
     * Get eloquent builder.
     *
     * @return Builder
     */
    public function builder(): Builder;

    /**
     * Get model by column.
     *
     * @param string $column
     * @param string $value
     * @param array $columns
     *
     * @return Model
     */
    public function getByColumn(string $column, string $value, array $columns = ['*']): Model;

    /**
     * Find model by column or return null if model not found.
     *
     * @param string $column
     * @param string $value
     * @param array $columns
     *
     * @return Model
     */
    public function findByColumn(string $column, string $value, array $columns = ['*']): ?Model;
}