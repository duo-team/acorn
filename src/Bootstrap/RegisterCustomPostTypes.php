<?php

namespace DuoTeam\Acorn\Bootstrap;

use DuoTeam\Acorn\Bootstrap\Common\Bootstrapper;
use DuoTeam\Acorn\Support\Posts\PostType;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Throwable;

class RegisterCustomPostTypes extends Bootstrapper
{
    /**
     * Register post types.
     *
     * @return void
     * @throws Throwable
     */
    public function handle(): void
    {
        $this->registerPostTypes($this->getPostTypes());
    }

    /**
     * Register post types in system.
     *
     * @param Collection $postTypes
     *
     * @return void
     * @throws Throwable
     */
    protected function registerPostTypes(Collection $postTypes): void
    {
        $postTypes->each(function (PostType $postType) {
            $postType->register();
        });
    }

    /**
     * Get post types as instances.
     *
     * @return Collection
     */
    protected function getPostTypes(): Collection
    {
        return $this->collectPostTypes()->map(function (string $postType) {
            return $this->app->make($postType);
        });
    }

    /**
     * Collect post types to register.
     *
     * @return Collection
     */
    protected function collectPostTypes(): Collection
    {
        $postTypes = $this->app['config']->get('post_types', []);
        $postTypes = Arr::wrap($postTypes);

        return collect($postTypes)
            ->filter(function ($value) {
                return is_string($value);
            })
            ->values();
    }
}