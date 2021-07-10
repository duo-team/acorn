<?php

namespace DuoTeam\Acorn\Database\Interfaces;

use Illuminate\Database\ConnectionInterface as Connection;

interface ConnectionInterface extends Connection
{
    /**
     * Get table prefix.
     *
     * @return string
     */
    public function getTablePrefix(): string;
}