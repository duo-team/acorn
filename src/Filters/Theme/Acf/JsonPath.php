<?php

namespace DuoTeam\Acorn\Filters\Theme\Acf;

use DuoTeam\Acorn\Support\Filter;
use Illuminate\Config\Repository as Configuration;
use function Roots\resource_path;

abstract class JsonPath extends Filter
{
    /**
     * @var Configuration
     */
    private $config;

    /**
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * Set ACF load JSON path.
     *
     * @return array
     */
    public function getLoadPath(): array
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
    public function getSavePath(): string
    {
        return $this->getJsonPath();
    }

    /**
     * Get ACF JSON path.
     *
     * @return string
     */
    public function getJsonPath(): string
    {
        return $this->config->get('acf.path', resource_path('acf'));
    }
}
