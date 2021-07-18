<?php

namespace DuoTeam\Acorn\Database;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * Create model.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->builder()->create($this->prepareAttributes($attributes));
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
        return $this->builder()->findOrFail($id, $columns);
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
        try {
            return $this->get($id, [$this->model()->getKeyName()])->delete();
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * Get eloquent builder instance.
     *
     * @return Builder
     */
    abstract protected function builder(): Builder;

    /**
     * Get model default attributes values.
     *
     * @return array
     */
    protected function defaultAttributes(): array
    {
        return [];
    }

    /**
     * Prepare attributes. Merge with defaults.
     *
     * @param array $attributes
     *
     * @return array
     */
    protected function prepareAttributes(array $attributes): array
    {
        return array_merge($this->defaultAttributes(), $attributes);
    }
}