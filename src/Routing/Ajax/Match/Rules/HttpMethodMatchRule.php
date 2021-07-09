<?php

namespace DuoTeam\Acorn\Routing\Ajax\Match\Rules;

use DuoTeam\Acorn\Routing\Ajax\Interfaces\MatchRuleInterface;
use DuoTeam\Acorn\Routing\Ajax\Route;
use DuoTeam\Acorn\Routing\Ajax\Router;
use DuoTeam\Acorn\Routing\Exceptions\MethodNotAllowedException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HttpMethodMatchRule implements MatchRuleInterface
{
    /**
     * Ajax router instance.
     *
     * @var Router
     */
    private $router;

    /**
     * Incoming request instance.
     *
     * @var Request
     */
    private $request;

    /**
     * @param Router $router
     * @param Request $request
     */
    public function __construct(Router $router, Request $request)
    {
        $this->router = $router;
        $this->request = $request;
    }

    /**
     * Verify route match.
     *
     * @param Route $route
     *
     * @return void
     */
    public function verify(Route $route): void
    {
        $incomingRequestMethod = Str::lower($this->request->method());
        $allowedHttpMethods = $this->findAllAllowedHttpMethodsForRoute($route);

        if (!in_array($incomingRequestMethod, $allowedHttpMethods, true)) {
            throw MethodNotAllowedException::byMethod($incomingRequestMethod, $allowedHttpMethods);
        }
    }

    /**
     * Get all allowed http methods for passed route.
     *
     * @param Route $route
     *
     * @return array
     */
    protected function findAllAllowedHttpMethodsForRoute(Route $route): array
    {
        return collect($this->router->routes())
            ->filter(function (Route $concurrentRoute) use ($route) {
                return $concurrentRoute->getAction() === $route->getAction();
            })
            ->map(function (Route $route) {
                return array_map([Str::class, 'upper'], $route->getMethods());
            })
            ->flatten()
            ->filter()
            ->unique()
            ->values()
            ->toArray();
    }
}