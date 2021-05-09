<?php

namespace DuoTeam\Acorn\Bootstrap;

use DuoTeam\Acorn\Support\Filter;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use InvalidArgumentException;
use ReflectionException;

class ApplyFilters
{
    /**
     * Application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * Bootstrap the given application.
     *
     * @param Application $app
     *
     * @return void
     * @throws ReflectionException
     * @throws BindingResolutionException
     */
    public function bootstrap(Application $app): void
    {
        $this->app = $app;
        $filters = $this->makeFilters(
            $this->app->config->get('filters', [])
        );

        foreach ($filters as $filter) {
            $filter->apply();
        }
    }

    /**
     * Make filters and make sure about contracts.
     *
     * @param array $filters
     *
     * @return Filter[]
     * @throws BindingResolutionException
     */
    protected function makeFilters(array $filters): array
    {
        return array_map(function (string $className) {
            $filter = $this->app->make($className);

            if (! is_a($filter, Filter::class)) {
                throw new InvalidArgumentException(
                    sprintf('Filter [%s] does not extends [%s] class.', $className, Filter::class)
                );
            }

            return $filter;
        }, $filters);
    }
}
