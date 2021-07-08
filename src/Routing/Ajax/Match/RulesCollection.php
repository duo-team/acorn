<?php

namespace DuoTeam\Acorn\Routing\Ajax\Match;

use Roots\Acorn\Application;

class RulesCollection
{
    /**
     * Rules collection items.
     *
     * @var array
     */
    protected $items = [];

    /**
     * @param iterable $items
     */
    public function __construct(iterable $items = [])
    {
        foreach ($items as $rule) {
            $this->add($rule);
        }
    }

    /**
     * Add rule to collection.
     *
     * @param $rule
     *
     * @return $this
     */
    public function add($rule): self
    {
        $this->items[] = $rule;

        return $this;
    }

    /**
     * Get all rules.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }
}