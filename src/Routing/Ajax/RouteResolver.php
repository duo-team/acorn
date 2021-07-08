<?php

namespace DuoTeam\Acorn\Routing\Ajax;

use DuoTeam\Acorn\Routing\Ajax\Match\RouteMatchVerifier;
use DuoTeam\Acorn\Routing\Ajax\Support\AjaxActionsResolver;
use DuoTeam\Acorn\Routing\Interfaces\RouteResolverInterface;
use Illuminate\Http\Request;
use function Roots\add_filters as add_filters;

class RouteResolver implements RouteResolverInterface
{
    /**
     * Router instance.
     *
     * @var Router
     */
    protected $router;

    /**
     * Current request.
     *
     * @var Request
     */
    protected $request;

    /**
     * Ajax actions resolver.
     *
     * @var AjaxActionsResolver
     */
    protected $actionsResolver;

    /**
     * Route match verifier.
     *
     * @var RouteMatchVerifier
     */
    protected $matchVerifier;

    /**
     * @param Router $router
     * @param AjaxActionsResolver $actionsResolver
     * @param RouteMatchVerifier $matchVerifier
     */
    public function __construct(Router $router, AjaxActionsResolver $actionsResolver, RouteMatchVerifier $matchVerifier)
    {
        $this->router = $router;
        $this->actionsResolver = $actionsResolver;
        $this->matchVerifier = $matchVerifier;
    }

    /**
     * Resolve routes routes.
     *
     * @return void
     */
    public function resolveRoutes(): void
    {
        foreach ($this->router->routes() as $route) {
            add_filters($this->actionsResolver->resolve($route), function () use ($route) {
                $this->matchVerifier->verifyRoute($route);

                dd($route);
            });
        }
    }
}