<?php

namespace DuoTeam\Acorn\Bootstrap\Exceptions;

use DuoTeam\Acorn\Bootstrap\Common\Bootstrapper;
use LogicException;

class MissingBootstrapHandleMethodException extends LogicException
{
    /**
     * Create new instance.
     *
     * @param Bootstrapper $instance
     * @param string $method
     *
     * @return MissingBootstrapHandleMethodException
     */
    public static function byBootstrapper(Bootstrapper $instance, string $method): MissingBootstrapHandleMethodException
    {
        return new self(
            sprintf('Missing [%s] method on bootstrapper [%s]', $method, get_class($instance))
        );
    }
}