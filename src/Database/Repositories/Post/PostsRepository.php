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
     * @throws \Throwable
     */
    public function create(array $attributes): Model
    {
        $modelId = wp_insert_post(array_merge($attributes, [
            'post_type' => $this->getPostType()->getValue()
        ]));

        if (is_wp_error($modelId)) {
            throw ModelInsertException::fromWordPressError($modelId);
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
            ->get();
    }

    /**
     * Get post by title.
     *
     * @param string $title
     *
     * @return Model
     */
    public function getByTitle(string $title): Model
    {
        return $this->getByColumn('post_title', $title);
    }

    /**
     * Get eloquent builder instance.
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return Post::query()
            ->where('post_type', '=', $this->getPostType()->getValue());
    }

    /**
     * Check if post exists by title.
     *
     * @param string $title
     *
     * @return bool
     */
    public function existsByTitle(string $title): bool
    {
        return $this->builder()
            ->where('post_title', 'like', sprintf('%%%s%%', $title))
            ->exists();
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