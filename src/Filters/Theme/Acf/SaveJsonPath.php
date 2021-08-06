<?php

namespace DuoTeam\Acorn\Filters\Theme\Acf;

class SaveJsonPath extends JsonPath
{
    /**
     * The filter tag it responds to.
     *
     * @var iterable
     */
    protected $tag = [
        'acf/settings/save_json',
    ];

    /**
     * Modify ACF save JSON path.
     *
     * @return string
     */
    public function handle(): string
    {
        return $this->getSavePath();
    }
}