<?php

namespace DuoTeam\Acorn\Database\Exceptions;

use RuntimeException;
use WP_Error as WpError;

class ModelInsertException extends RuntimeException
{
    /**
     * Create exception instance by WP error.
     *
     * @param WpError $error
     *
     * @return ModelInsertException
     */
    public static function byWpError(WpError $error): ModelInsertException
    {
        return new self($error->get_error_message());
    }
}