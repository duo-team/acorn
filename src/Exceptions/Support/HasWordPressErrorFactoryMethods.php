<?php

namespace DuoTeam\Acorn\Exceptions\Support;

use Throwable;
use WP_Error as WordPressError;

trait HasWordPressErrorFactoryMethods
{
    /**
     * Build exception
     * @param WordPressError $error
     * @param string|int $code
     *
     * @return Throwable
     */
    public static function fromWordPressError(WordPressError $error, $code = ''): Throwable
    {
        $message = $error->get_error_message($code);

        return new static($message);
    }
}