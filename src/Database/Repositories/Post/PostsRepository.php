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
     * Post ID for does not exists post.
     */
    protected const NO_EXISTS_POST_ID = 0;

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
            'post_type' => $this->getPostType()
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
     * Check if post exists by title.
     *
     * @param string $title
     *
     * @return bool
     */
    public function existsByTitle(string $title): bool
    {
        return post_exists($title) > self::NO_EXISTS_POST_ID;
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