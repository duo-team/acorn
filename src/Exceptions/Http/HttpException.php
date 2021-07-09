<?php

namespace DuoTeam\Acorn\Exceptions\Http;

use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException as Exception;
use Throwable;

class HttpException extends Exception
{
    /**
     * Error message.
     *
     * @var string
     */
    protected $message = 'Something goes wrong.';

    /**
     * Status code.
     *
     * @var int
     */
    protected $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * @param int|null $statusCode
     * @param string|null $message
     * @param Throwable|null $previous
     * @param array $headers
     * @param int $code
     */
    public function __construct(
        int $statusCode = null,
        string $message = null,
        Throwable $previous = null,
        array $headers = [],
        int $code = 0
    ) {
        $statusCode = $statusCode ?? $this->statusCode;
        $message = $message ?? $this->message;

        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }
}