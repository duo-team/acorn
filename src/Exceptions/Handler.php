<?php

namespace DuoTeam\Acorn\Exceptions;

use DuoTeam\Acorn\Exceptions\Response\Interfaces\ResponseFactoryInterface;
use DuoTeam\Acorn\Exceptions\Response\JsonExceptionResponseFactory;
use Illuminate\Http\Request;
use Roots\Acorn\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into a response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return string
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e): string
    {
        if ($request->wantsJson() || wp_doing_ajax()) {
            $this->renderExceptionAsJsonResponse($request, $e);
        }

        return parent::render($request, $e);
    }

    /**
     * Render json exception.
     *
     * @param Request $request
     * @param Throwable $e
     *
     * @return void
     */
    protected function renderExceptionAsJsonResponse(Request $request, Throwable $e): void
    {
        $this->jsonResponseFactory()->build($request, $e);
    }

    /**
     * Build JSON response factory.
     *
     * @return ResponseFactoryInterface
     */
    protected function jsonResponseFactory(): ResponseFactoryInterface
    {
        return $this->container->make(JsonExceptionResponseFactory::class);
    }
}