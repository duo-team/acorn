<?php

namespace DuoTeam\Acorn\Exceptions\Response\Interfaces;

use Illuminate\Http\Request;
use Throwable;

interface ResponseFactoryInterface
{
    /**
     * Build response.
     *
     * @param Request $request
     * @param Throwable $exception
     *
     * @return mixed
     */
    public function build(Request $request, Throwable $exception);
}