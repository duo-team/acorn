<?php

namespace DuoTeam\Acorn\Database\Exceptions;

use RuntimeException;
use WP_Error as WpError;

class PostInsertException extends RuntimeException
{
    /**
     * Create exception instance by WP error.
     *
     * @param WpError $error
     *
     * @return PostInsertException
     */
    public static function byWpError(WpError $error): PostInsertException
    {
        return new self($error->get_error_message());
    }
}