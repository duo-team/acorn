<?php

namespace DuoTeam\Acorn\Database\Exceptions;

use Throwable;

class AttemptToChangeDefaultConnectionException extends \InvalidArgumentException
{
    /**
     * Build exception by message with names.
     *
     * @param string $connectionName
     * @param string $allowedConnectionName
     *
     * @return static
     */
    public static function byConnectionName(string $connectionName, string $allowedConnectionName): self
    {
        return new self(sprintf(
            'Cannot change default connection to [%s]. Only allowed is [%s]',
            $connectionName,
            $allowedConnectionName
        ));
    }
}