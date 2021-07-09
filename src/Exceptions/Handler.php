<?php

namespace DuoTeam\Acorn\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Roots\Acorn\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
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
            $this->renderJsonException($request, $e);
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
    protected function renderJsonException(Request $request, Throwable $e): void
    {
        $content = [];
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($e instanceof HttpExceptionInterface) {
            $content = ["message" => $e->getMessage()];
            $status = $e->getStatusCode();
        }

        wp_send_json($content, $status);
    }
}