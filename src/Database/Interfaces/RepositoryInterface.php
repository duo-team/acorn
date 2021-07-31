<?php

namespace DuoTeam\Acorn\Database\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    /**
     * Create model.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Update model and return updated.
     *
     * @param string $id
     * @param array $attributes
     *
     * @return Model
     */
    public function update(string $id, array $attributes): Model;

    /**
     * Get model with id or fail.
     *
     * @param string $id
     * @param string[] $columns
     *
     * @return Model
     */
    public function get(string $id, array $columns = ['*']): Model;

    /**
     * Get model with id or return null.
     *
     * @param string $id
     * @param string[] $columns
     *
     * @return Model
     */
    public function find(string $id, array $columns = ['*']): ?Model;

    /**
     * Get all models.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Delete model from database.
     *
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id): bool;

    /**
     * Check if resource exists.
     *
     * @param string $id
     *
     * @return bool
     */
    public function exists(string $id): bool;
}