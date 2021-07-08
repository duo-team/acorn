<?php

namespace DuoTeam\Acorn\Routing\Ajax\Interfaces;

interface AjaxRouteInterface
{
    /**
     * Get route Ajax action.
     *
     * @return string
     */
    public function getAction(): string;

    /**
     * Set route open for all.
     *
     * @return void
     */
    public function markAsPublic(): void;

    /**
     * Set route as only for authorized users.
     *
     * @return void
     */
    public function markAsProtected(): void;

    /**
     * Check if route is public.
     *
     * @return bool
     */
    public function isPublic(): bool;
}