<?php


namespace DuoTeam\Acorn\Database\Support\Repositories;


use DuoTeam\Acorn\Database\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
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
     * Get used model instance.
     *
     * @return Model
     */
    protected function model(): Model
    {
        return $this->builder()->getModel();
    }
}