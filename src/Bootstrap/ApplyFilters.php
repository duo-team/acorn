<?php

namespace DuoTeam\Acorn\Bootstrap;

use DuoTeam\Acorn\Support\Filter;
use Illuminate\Contracts\Foundation\Application;
use InvalidArgumentException;

class ApplyFilters
{
    /**
     * Ready to use filters.
     *
     * @var Filter[]
     */
    protected $filters = [];

    /**
     * Bootstrap the given application.
     *
     * @param Application $app
     *
     * @return void
     * @throws \ReflectionException
     */
    public function bootstrap(Application $app): void
    {
        $this->makeFilters(
            $app->get('config')->get('filters', [])
        );

        foreach ($this->filters as $filter) {
            $filter->apply();
        }
    }

    /**
     * Make filters and make sure about contracts.
     *
     * @param array $filters
     *
     * @return void
     */
    protected function makeFilters(array $filters): void
    {
        $this->filters = array_map(static function (string $className) {
            $filter = app()->make($className);

            if (! is_a($filter, Filter::class)) {
                throw new InvalidArgumentException(
                    sprintf('Filter [%s] does not extends [%s] class.', $className, Filter::class)
                );
            }

            return $filter;
        }, $filters);
    }
}
