<?php


namespace DuoTeam\Acorn\Exceptions\Response\Transformers;


use Illuminate\Validation\ValidationException;
use Throwable;

class ValidationExceptionTransformer extends ExceptionTransformer
{
    /**
     * Transform exception into json response.
     *
     * @param Throwable|ValidationException $exception
     *
     * @return array
     */
    public function transform(Throwable $exception): array
    {

        return [
            'message' => trans('application.errors.validation'),
            'errors' => $exception->validator->errors()->getMessages()
        ];
    }

}