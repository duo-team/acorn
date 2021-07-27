<?php

namespace DuoTeam\Acorn\Bootstrap;

use DuoTeam\Acorn\Bootstrap\Common\Bootstrapper;
use DuoTeam\Acorn\Support\Filter;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use ReflectionException;

class ApplyFilters extends Bootstrapper
{
    /**
     * Handle bootstrap.
     *
     * @return void
     * @throws ReflectionException
     */
    public function handle(): void
    {
        $this->applyFilters($this->getFilters());
    }

    /**
     * Apply filters in system.
     *
     * @param Collection $filters
     * @throws ReflectionException
     */
    protected function applyFilters(Collection $filters): void
    {
        $filters->each(function (Filter $filter) {
            $filter->apply();
        });
    }

    /**
     * Get collected filters and make it by container.
     *
     * @return Collection
     */
    protected function getFilters(): Collection
    {
        return $this->collectFilters()->map(function (string $filter) {
            return $this->app->make($filter);
        });
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

        return collect($filters)
            ->filter(function ($value) {
                return is_string($value);
            })
            ->values();
    }
}
