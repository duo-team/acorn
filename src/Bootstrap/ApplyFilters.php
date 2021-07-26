<?php

namespace DuoTeam\Acorn\Bootstrap;

use DuoTeam\Acorn\Bootstrap\Common\Bootstrapper;
use DuoTeam\Acorn\Support\Filter;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ApplyFilters extends Bootstrapper
{
    /**
     * Handle bootstrap.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->applyFilters($this->getFilters());
    }

    /**
     * Collect filters from application config.
     *
     * @return Collection
     */
    protected function collectFilters(): Collection
    {
        $filters = $this->app['config']->get('filters', []);
        $filters = Arr::wrap($filters);

        return collect($filters)->filter('is_string')->values();
    }

    /**
     * Get collected filters and make it by container.
     *
     * @return Collection
     */
    protected function getFilters(): Collection
    {
        return $this->collectFilters()->map(function (string $filter) {
            $this->app->make($filter);
        });
    }

    /**
     * Apply filters in system.
     *
     * @param Collection $filters
     */
    protected function applyFilters(Collection $filters): void
    {
        $filters->each(function (Filter $filter) {
            $filter->apply();
        });
    }
}
