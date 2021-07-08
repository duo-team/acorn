<?php

namespace DuoTeam\Acorn\Routing\Ajax\Support;

use DuoTeam\Acorn\Routing\Ajax\Interfaces\AjaxRouteInterface;
use Illuminate\Support\Str;

class AjaxActionsResolver
{
    protected const AJAX_HOOK_FOR_AUTH = 'wp_ajax';
    protected const AJAX_HOOK_FOR_GUESTS = 'wp_ajax_nopriv';

    /**
     * Resolve Ajax actions.
     *
     * @param AjaxRouteInterface $route
     *
     * @return iterable
     */
    public function resolve(AjaxRouteInterface $route): iterable
    {
        $routeAction = $route->getAction();
        $actions = [
            $this->composeActionName(self::AJAX_HOOK_FOR_AUTH, $routeAction)
        ];

        if ($route->isPublic()) {
            $actions[] = $this->composeActionName(self::AJAX_HOOK_FOR_GUESTS, $routeAction);
        }

        return $actions;
    }

    /**
     * Compose ajax action hook.
     *
     * @param string $hook
     * @param string $action
     *
     * @return string
     */
    protected function composeActionName(string $hook, string $action): string
    {
        return Str::of(sprintf('%s_%s', $hook, $action))->snake()->lower();
    }
}