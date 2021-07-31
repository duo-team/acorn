<?php

namespace DuoTeam\Acorn\Database\Repositories\Post;

use DuoTeam\Acorn\Database\Exceptions\ModelInsertException;
use DuoTeam\Acorn\Database\Models\Post\Post;
use DuoTeam\Acorn\Database\Support\Repositories\EloquentRepository;
use DuoTeam\Acorn\Enums\Post\PostTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class PostsRepository extends EloquentRepository
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
        $modelId = wp_insert_post(array_merge($attributes, [
            'post_type' => $this->getPostType()
        ]));

        if (is_wp_error($modelId)) {
            throw ModelInsertException::byWpError($modelId);
        }

        return $this->get($modelId);
    }

    /**
     * Get all models.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->builder()
            ->where('post_type', '=', $this->getPostType())
            ->get();
    }

    /**
     * Get eloquent builder instance.
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return Post::query();
    }

    /**
     * Get used post type.
     *
     * @return PostTypeEnum
     */
    protected function getPostType(): PostTypeEnum
    {
        return PostTypeEnum::POST();
    }
}