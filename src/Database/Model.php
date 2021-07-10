<?php

namespace DuoTeam\Acorn\Database;

use DuoTeam\Acorn\Database\Interfaces\ConnectionInterface;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    /**
     * The connection resolver instance.
     *
     * @var ConnectionResolver
     */
    protected static $resolver;

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable(): string
    {
        if ($this->table) {
            return $this->table;
        }

        return sprintf('%s%s', $this->getConnection()->getTablePrefix(), parent::getTable());
    }

    /**
     * Get the database connection for the model.
     *
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return static::resolveConnection($this->getConnectionName());
    }

    /**
     * Resolve a connection instance.
     *
     * @param string|null $connection
     *
     * @return ConnectionInterface
     */
    public static function resolveConnection($connection = null): ConnectionInterface
    {
        return static::$resolver->connection($connection);
    }
}