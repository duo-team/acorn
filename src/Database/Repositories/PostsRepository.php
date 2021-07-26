<?php

namespace DuoTeam\Acorn\Database\Repositories;

use DuoTeam\Acorn\Database\Exceptions\PostInsertException;
use DuoTeam\Acorn\Database\Models\Post\Post;
use DuoTeam\Acorn\Database\Repository;
use DuoTeam\Acorn\Enums\Post\PostCommentStatusEnum;
use DuoTeam\Acorn\Enums\Post\PostPingStatusEnum;
use DuoTeam\Acorn\Enums\Post\PostStatusEnum;
use DuoTeam\Acorn\Enums\Post\PostTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostsRepository extends Repository
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
        $modelId = wp_insert_post($this->prepareAttributes($attributes));

        if (is_wp_error($modelId)) {
            throw PostInsertException::byWpError($modelId);
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
            ->where('post_type', '=', $this->postType())
            ->get();
    }

    /**
     * Get eloquent builder instance.
     *
     * @return Builder
     */
    protected function builder(): Builder
    {
        return Post::query();
    }

    /**
     * @return PostTypeEnum
     */
    protected function postType(): PostTypeEnum
    {
        return PostTypeEnum::POST();
    }

    /**
     * Get model default attributes values.
     *
     * @return array
     */
    protected function defaultAttributes(): array
    {
        return [
            'post_content' => '',
            'post_title' => '',
            'post_excerpt' => '',
            'post_status' => PostStatusEnum::PRIVATE(),
            'comment_status' => PostCommentStatusEnum::CLOSED(),
            'ping_status' => PostPingStatusEnum::CLOSED(),
        ];
    }
}