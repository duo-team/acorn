<?php

namespace DuoTeam\Acorn\Routing\Ajax\Match;

use DuoTeam\Acorn\Routing\Ajax\Interfaces\MatchRuleInterface;
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
     * @param MatchRuleInterface $rule
     *
     * @return $this
     */
    public function add(MatchRuleInterface $rule): self
    {
        $this->items[] = $rule;

        return $this;
    }

    /**
     * Get all rules.
     *
     * @return MatchRuleInterface[]
     */
    public function all(): array
    {
        return $this->items;
    }
}