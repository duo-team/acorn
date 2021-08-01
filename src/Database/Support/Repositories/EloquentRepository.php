<?php


namespace DuoTeam\Acorn\Database\Support\Repositories;


use DuoTeam\Acorn\Database\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

abstract class EloquentRepository implements EloquentRepositoryInterface
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
        return $this->builder()->create($attributes);
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
     * Get model by column.
     *
     * @param string $column
     * @param string $value
     * @param array $columns
     *
     * @return Model
     */
    public function getByColumn(string $column, string $value, array $columns = ['*']): Model
    {
        $model = $this->findByColumn($column, $value, $columns);

        if (!$model) {
            $this->throwNotFoundException([sprintf('[%s => %s]', $column, $value)]);
        }

        return $model;
    }

    /**
     * Find model by column or return null if model not found.
     *
     * @param string $column
     * @param string $value
     * @param array $columns
     *
     * @return Model
     */
    public function findByColumn(string $column, string $value, array $columns = ['*']): ?Model
    {
        return $this->builder()
            ->select($columns)
            ->where($column, '=', $value)
            ->first();
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
        $model = $this->find($id, $columns);

        if (!$model) {
            $this->throwNotFoundException([$id]);
        }

        return $model;
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
        return $this->builder()->find($id);
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
        return $this->builder()
            ->where($this->model()->getKeyName(), '=', $id)
            ->delete();
    }

    /**
     * Check if resource exists.
     *
     * @param string $id
     *
     * @return bool
     */
    public function exists(string $id): bool
    {
        return $this->builder()
            ->where($this->model()->getKeyName(), '=', $id)
            ->exists();
    }

    /**
     * Check if post exists by attributes.
     *
     * @param array $attributes
     *
     * @return bool
     */
    public function existsByAttributes(array $attributes): bool
    {
        return $this->builder()->where($attributes)->exists();
    }

    /**
     * Get random model.
     *
     * @return Model|null
     */
    public function random(): ?Model
    {
        return $this->builder()->inRandomOrder()->first();
    }


    /**
     * Get used model instance.
     *
     * @return Model
     */
    protected function model(): Model
    {
        return $this->builder()->getModel();
    }

    /**
     * Throw not found exception for model.
     *
     * @param array $ids
     *
     * @return void
     */
    protected function throwNotFoundException(array $ids): void
    {
        throw (new ModelNotFoundException)->setModel(
            get_class($this->model()), $ids
        );
    }
}