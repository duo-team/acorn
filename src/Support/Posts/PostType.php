<?php

namespace DuoTeam\Acorn\Support\Posts;

use DuoTeam\Acorn\Enums\Post\PostTypeEnum;
use DuoTeam\Acorn\Support\Posts\Exceptions\RegisterPostTypeException;
use Throwable;

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
     * @return PostTypeArgs
     */
    public function getArgs(): PostTypeArgs
    {
        return $this->args;
    }

    /**
     * Register post in system.
     *
     * @return void
     * @throws Throwable
     */
    public function register(): void
    {
        $result = register_post_type(
            $this->getPostType()->getValue(),
            $this->getArgs()->toArray()
        );

        if (is_wp_error($result)) {
            throw RegisterPostTypeException::fromWordPressError($result);
        }
    }
}