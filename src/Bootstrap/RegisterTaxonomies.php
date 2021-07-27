<?php

namespace DuoTeam\Acorn\Bootstrap;

use DuoTeam\Acorn\Bootstrap\Common\Bootstrapper;
use DuoTeam\Acorn\Support\Taxonomies\Taxonomy;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Throwable;

class RegisterTaxonomies extends Bootstrapper
{
    /**
     * Register taxonomies.
     *
     * @throws Throwable
     */
    public function handle(): void
    {
        $this->registerTaxonomies($this->getTaxonomies());
    }

    /**
     * Register collected taxonomies.
     *
     * @param Collection $taxonomies
     *
     * @throws Throwable
     */
    protected function registerTaxonomies(Collection $taxonomies): void
    {
        $taxonomies->each(function (Taxonomy $taxonomy) {
            $taxonomy->register();
        });
    }

    /**
     * Get taxonomies resolved by container.
     *
     * @return Collection
     */
    protected function getTaxonomies(): Collection
    {
        return $this->collectTaxonomies()->map(function (string $taxonomy) {
            return $this->app->make($taxonomy);
        });
    }

    /**
     * Collect taxonomies from application config.
     *
     * @return Collection
     */
    protected function collectTaxonomies(): Collection
    {
        $taxonomies = $this->app['config']->get('taxonomies', []);
        $taxonomies = Arr::wrap($taxonomies);

        return collect($taxonomies)
            ->filter(function ($value) {
                return is_string($value);
            })
            ->values();
    }
}