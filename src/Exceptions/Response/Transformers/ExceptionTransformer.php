<?php

namespace DuoTeam\Acorn\Exceptions\Response\Transformers;

use DuoTeam\Acorn\Resources\Transformers\AbstractTransformer;
use Illuminate\Http\Response;
use Roots\Acorn\Application;
use Throwable;

class ExceptionTransformer extends AbstractTransformer
{
    /**
     * Status code.
     *
     * @var int
     */
    protected $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * @var Application
     */
    protected $application;

    /**
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Transform exception into json response.
     *
     * @param Throwable $exception
     *
     * @return array
     */
    public function transform(Throwable $exception): array
    {
        return array_merge(
            $this->buildBaseContent($exception),
            $this->buildAdditionalContent($exception)
        );
    }

    /**
     * @param Throwable $exception
     * @return array
     */
    protected function buildAdditionalContent(Throwable $exception): array
    {
        if ($this->isProduction()) {
            return [];
        }

        return [
            'exception' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace()
        ];
    }

    /**
     * @param Throwable $exception
     * @return array
     */
    protected function buildBaseContent(Throwable $exception): array
    {
        $message = $exception->getMessage();

        if ($this->statusCode >= Response::HTTP_INTERNAL_SERVER_ERROR && $this->isProduction()) {
            $message = trans('application.errors.general');
        }

        return [
            'message' => $message
        ];
    }

    /**
     * @return bool
     */
    protected function isProduction(): bool
    {
        return $this->application->environment('prod*');
    }

    /**
     * @param int $statusCode
     *
     * @return ExceptionTransformer
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}