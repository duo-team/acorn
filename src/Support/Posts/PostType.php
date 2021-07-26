<?php

namespace DuoTeam\Acorn\Support\Posts;

use DuoTeam\Acorn\Enums\Post\PostTypeEnum;
use DuoTeam\Acorn\Support\Posts\Exceptions\RegisterPostException;

abstract class PostType
{
    /**
     * @var PostTypeArgs
     */
    private $args;

    /**
     * @param PostTypeArgs $args
     */
    public function __construct(PostTypeArgs $args)
    {
        $this->args = $args;
    }

    /**
     * Get custom post type.
     *
     * @return PostTypeEnum
     */
    abstract public function getPostType(): PostTypeEnum;

    /**
     * Get args used for registering.
     *
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args->toArray();
    }

    /**
     * Register post in system.
     *
     * @return void
     */
    public function register(): void
    {
        $result = register_post_type($this->getPostType(), $this->getArgs());

        if (is_wp_error($result)) {
            throw new RegisterPostException($result->get_error_message());
        }
    }
}