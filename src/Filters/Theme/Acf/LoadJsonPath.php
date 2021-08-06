<?php

namespace DuoTeam\Acorn\Filters\Theme\Acf;

class LoadJsonPath extends JsonPath
{
    /**
     * The filter tag it responds to.
     *
     * @var iterable
     */
    protected $tag = [
        'acf/settings/load_json',
    ];

    /**
     * Modify ACF load JSON path.
     *
     * @return array
     */
    public function handle(): array
    {
        return $this->getLoadPath();
    }
}