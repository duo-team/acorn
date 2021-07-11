<?php

namespace DuoTeam\Acorn\Exceptions\Http;

use Illuminate\Http\Response;

class AuthorizationException extends HttpException
{
    /**
     * Error message.
     *
     * @var string
     */
    protected $message = 'Unauthorized.';

    /**
     * Status code.
     *
     * @var int
     */
    protected $statusCode = Response::HTTP_FORBIDDEN;
}