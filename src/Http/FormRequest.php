<?php

namespace DuoTeam\Acorn\Http;

use DuoTeam\Acorn\Exceptions\Http\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest as Request;

abstract class FormRequest extends Request
{
    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException;
    }

    /**
     * Get the URL to redirect to on a validation error.
     *
     * @return string
     */
    protected function getRedirectUrl(): string
    {
        return get_home_url();
    }
}
