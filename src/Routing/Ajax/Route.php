<?php

namespace DuoTeam\Acorn\Routing\Ajax;

use DuoTeam\Acorn\Routing\Ajax\Interfaces\AjaxRouteInterface;
use DuoTeam\Acorn\Routing\Interfaces\RouteInterface;

class Route implements RouteInterface, AjaxRouteInterface
{
    /**
     * If that route is for guest?
     *
     * @var bool
     */
    protected $isPublic = true;

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
     * @var callable|string
     */
    protected $handler;

    /**
     * @param array $methods
     * @param string $action
     * @param callable|string $handler
     * @param bool $isPublic
     */
    public function __construct(array $methods, string $action, $handler, bool $isPublic = true)
    {
        $this->methods = $methods;
        $this->action = $action;
        $this->handler = $handler;
        $this->isPublic = $isPublic;
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
     * @return callable|string
     */
    public function getHandler()
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

    /**
     * Set route open for all.
     *
     * @return void
     */
    public function markAsPublic(): void
    {
        $this->isPublic = true;
    }

    /**
     * Set route as only for authorized users.
     *
     * @return void
     */
    public function markAsProtected(): void
    {
        $this->isPublic = false;
    }

    /**
     * Check if route is public.
     *
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->isPublic;
    }
}
