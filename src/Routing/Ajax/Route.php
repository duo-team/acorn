<?php

namespace DuoTeam\Acorn\Routing\Ajax;

class Route
{
    /**
     * Allowed HTTP methods.
     *
     * @var array
     */
    protected $methods;

    /**
     * Route Ajax action.
     *
     * @var string
     */
    protected $action;

    /**
     * Route handler.
     *
     * @var callable
     */
    protected $handler;

    /**
     * @param array $methods
     * @param string $action
     * @param callable $handler
     */
    public function __construct(array $methods, string $action, callable $handler)
    {
        $this->methods = $methods;
        $this->action = $action;
        $this->handler = $handler;
    }

    /**
     * Get route Ajax action.
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Get route handler.
     *
     * @return callable
     */
    public function getHandler(): callable
    {
        return $this->handler;
    }

    /**
     * Get allowed methods.
     *
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
}