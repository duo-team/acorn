<?php

namespace DuoTeam\Acorn\Database;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

abstract class Repository
{
    /**
     * Get model instance.
     *
     * @return Model
     */
    abstract public function model(): Model;

    /**
     * Get eloquent builder instance.
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return $this->model()->newQuery();
    }

    /**
     * Get model default attributes values.
     *
     * @return array
     */
    public function defaultAttributes(): array
    {
        return [];
    }

    /**
     * Create model.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $modelId = wp_insert_post($this->prepareAttributes($attributes));

        if (is_wp_error($modelId)) {
            throw new RuntimeException($modelId->get_error_message());
        }

        return $this->get($modelId);
    }

    /**
     * Update model and return updated.
     *
     * @param string $id
     * @param array $attributes
     *
     * @return Model
     */
    public function update(string $id, array $attributes): Model
    {
        $model = $this->get($id);
        $model->update($attributes);

        return $model->refresh();
    }

    /**
     * Get model with id or fail.
     *
     * @param string $id
     * @param string[] $columns
     *
     * @return Model
     */
    public function get(string $id, array $columns = ['*']): Model
    {
        return $this->builder()
            ->where($this->model()->getKeyName(), '=', $id)
            ->firstOrFail($columns);
    }

    /**
     * Get model with id or return null.
     *
     * @param string $id
     * @param string[] $columns
     *
     * @return Model
     */
    public function find(string $id, array $columns = ['*']): ?Model
    {
        return $this->builder()
            ->where($this->model()->getKeyName(), '=', $id)
            ->first($columns);
    }

    /**
     * Get all models.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->builder()->get();
    }

    /**
     * Delete model from database.
     *
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->get($id, [$this->model()->getKeyName()])->delete();
    }

    /**
     * Prepare attributes. Merge with defaults.
     *
     * @param array $attributes
     *
     * @return array
     */
    public function prepareAttributes(array $attributes): array
    {
        return array_merge($this->defaultAttributes(), $attributes);
    }
}