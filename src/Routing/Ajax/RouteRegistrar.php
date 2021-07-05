<?php

namespace DuoTeam\Acorn\Routing\Ajax;

use Illuminate\Http\Request;

class RouteRegistrar
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
     * @param Router $router
     * @param Request $request
     */
    public function __construct(Router $router, Request $request)
    {
        $this->router = $router;
        $this->request = $request;
    }

    public function register()
    {
        foreach ($this->router->routes() as $route) {
            // wp_ajax_nopriv_{$akcja}
            // wp_ajax_{$akcja}

            add_action(sprintf('wp_ajax_nopriv_%s', $route->getAction()), function () use ($route) {
                if (! in_array($this->request->method(), $route->getMethods())) {
                    // 405
                }

                app()->call($route->getHandler());
            });
        }
    }
}