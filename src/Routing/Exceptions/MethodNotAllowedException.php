<?php

namespace DuoTeam\Acorn\Routing\Exceptions;

use DuoTeam\Acorn\Exceptions\Http\HttpException;
use Illuminate\Http\Response;

class MethodNotAllowedException extends HttpException
{
    /**
     * Error message.
     *
     * @var string
     */
    protected $message = 'HTTP method not allowed.';

    /**
     * Status code.
     *
     * @var int
     */
    protected $statusCode = Response::HTTP_METHOD_NOT_ALLOWED;

    /**
     * Build exception fro route.
     *
     * @param string $usedMethod
     * @param array $allowedMethods
     *
     * @return static
     */
    public static function byMethod(string $usedMethod, array $allowedMethods): self
    {
        $message = sprintf(
            'HTTP method [%s] is not allowed here. Supported methods: [%s]',
            $usedMethod,
            implode(', ', $allowedMethods)
        );

        return new self(Response::HTTP_METHOD_NOT_ALLOWED, $message);
    }
}