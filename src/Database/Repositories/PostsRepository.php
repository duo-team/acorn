<?php

namespace DuoTeam\Acorn\Database\Repositories;

use DuoTeam\Acorn\Database\Exceptions\PostInsertException;
use DuoTeam\Acorn\Database\Models\Post\Post;
use DuoTeam\Acorn\Database\Repository;
use DuoTeam\Acorn\Enums\PostCommentStatusEnum;
use DuoTeam\Acorn\Enums\PostPingStatus;
use DuoTeam\Acorn\Enums\PostStatusEnum;
use DuoTeam\Acorn\Enums\PostTypeEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostsRepository extends Repository
{
    /**
     * Post model instance.
     *
     * @var Post
     */
    private $model;

    /**
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * Get model instance.
     *
     * @return Model
     */
    public function model(): Model
    {
        return $this->model;
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
            throw PostInsertException::byWpError($modelId);
        }

        return $this->get($modelId);
    }

    /**
     * Get model default attributes values.
     *
     * @return array
     */
    public function defaultAttributes(): array
    {
        return [
            'post_content' => '',
            'post_title' => '',
            'post_excerpt' => '',
            'post_status' => PostStatusEnum::PRIVATE(),
            'comment_status' => PostCommentStatusEnum::CLOSED(),
            'ping_status' => PostPingStatus::CLOSED(),
        ];
    }

    /**
     * Get all models.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->builder()
            ->where('post_type', '=', PostTypeEnum::POST())
            ->get();
    }
}