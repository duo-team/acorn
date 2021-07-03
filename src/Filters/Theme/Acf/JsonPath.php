<?php

namespace DuoTeam\Acorn\Filters\Theme\Acf;

use DuoTeam\Acorn\Support\Filter;

class JsonPath extends Filter
{
    /**
     * Modify ACF JSON paths.
     *
     * @return void
     */
    public function handle(): void
    {
        add_filter('acf/settings/save_json', [$this, 'setSavePath']);
        add_filter('acf/settings/load_json', [$this, 'setLoadPath']);
    }

    /**
     * Set ACF load JSON path.
     *
     * @return array
     */
    public function setLoadPath(): array
    {
        return [
            $this->getJsonPath(),
        ];
    }

    /**
     * Set ACF save JSON path.
     *
     * @return string
     */
    public function setSavePath(): string
    {
        return $this->getJsonPath();
    }

    /**
     * Get ACF JSON path.
     *
     * @return string
     */
    protected function getJsonPath(): string
    {
        return config('acf.path', resource_path('acf'));
    }
}
