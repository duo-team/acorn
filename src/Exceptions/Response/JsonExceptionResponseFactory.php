<?php

namespace DuoTeam\Acorn\Exceptions\Response;

use DuoTeam\Acorn\Exceptions\Response\Interfaces\ResponseFactoryInterface;
use DuoTeam\Acorn\Exceptions\Response\Interfaces\TransformableExceptionInterface;
use DuoTeam\Acorn\Exceptions\Response\Transformers\ExceptionTransformer;
use DuoTeam\Acorn\Exceptions\Response\Transformers\ValidationExceptionTransformer;
use DuoTeam\Acorn\Resources\Managers\ResourceTransformerManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Roots\Acorn\Application;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class JsonExceptionResponseFactory implements ResponseFactoryInterface
{
    /**
     * Exception transformers.
     *
     * @var array
     */
    protected $exceptionTransformers = [
        ValidationException::class => ValidationExceptionTransformer::class
    ];

    /**
     * Exception statuses.
     *
     * @var array
     */
    protected $exceptionStatuses = [
        ModelNotFoundException::class => Response::HTTP_NOT_FOUND,
        ValidationException::class => Response::HTTP_UNPROCESSABLE_ENTITY
    ];

    /**
     * @var ResourceTransformerManager
     */
    protected $transformerManager;

    /**
     * @var Application
     */
    protected $application;

    /**
     * @param ResourceTransformerManager $transformerManager
     * @param Application $application
     */
    public function __construct(ResourceTransformerManager $transformerManager, Application $application)
    {
        $this->transformerManager = $transformerManager;
        $this->application = $application;
    }

    /**
     * Build response.
     *
     * @param Request $request
     * @param Throwable $exception
     *
     * @return void
     */
    public function build(Request $request, Throwable $exception)
    {
        $statusCode = $this->resolveStatusCodeForException($exception);
        $transformer = $this->resolveTransformerForException($exception)->setStatusCode($statusCode);

        wp_send_json(
            $this->transformerManager->item($exception, $transformer),
            $statusCode
        );
    }

    /**
     * Resolve status code for exception.
     *
     * @param Throwable $exception
     *
     * @return int
     */
    protected function resolveStatusCodeForException(Throwable $exception): int
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($this->hasExceptionStatus($exception)) {
            $status = $this->getExceptionStatus($exception);
        }

        if ($exception instanceof HttpExceptionInterface) {
            $status = $exception->getStatusCode();
        }

        return $status;
    }

    /**
     * Resolve transformer for exception.
     *
     * @param Throwable $exception
     *
     * @return mixed
     */
    protected function resolveTransformerForException(Throwable $exception): ExceptionTransformer
    {
        $transformer = ExceptionTransformer::class;

        if ($this->hasExceptionTransformer($exception)) {
            $transformer = $this->getExceptionTransformer($exception);
        }

        if ($exception instanceof TransformableExceptionInterface) {
            $transformer = $exception->getTransformer();
        }

        return $this->application->make($transformer);
    }

    /**
     * Has defined exception transformer.
     *
     * @param Throwable $exception
     *
     * @return bool
     */
    protected function hasExceptionTransformer(Throwable $exception): bool
    {
        return (bool) data_get($this->exceptionTransformers, get_class($exception));
    }

    /**
     * Get exception transformer from list.
     *
     * @param Throwable $exception
     *
     * @return string
     */
    protected function getExceptionTransformer(Throwable $exception): string
    {
        $transformer = data_get($this->exceptionTransformers, get_class($exception));

        if (empty($transformer)) {
            $transformer = ExceptionTransformer::class;
        }

        return $transformer;
    }

    /**
     * Check if have exception status.
     *
     * @param Throwable $exception
     * @return bool
     */
    protected function hasExceptionStatus(Throwable $exception): bool
    {
        return (bool) data_get($this->exceptionStatuses, get_class($exception));
    }

    /**
     * Get exception status from list.
     *
     * @param Throwable $exception
     *
     * @return int
     */
    protected function getExceptionStatus(Throwable $exception): int
    {
        $status = data_get($this->exceptionStatuses, get_class($exception));

        if (empty($status)) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $status;
    }
}