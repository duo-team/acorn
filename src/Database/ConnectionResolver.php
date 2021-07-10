<?php

namespace DuoTeam\Acorn\Database;

use DuoTeam\Acorn\Database\Exceptions\AttemptToChangeDefaultConnectionException;
use DuoTeam\Acorn\Database\Interfaces\ConnectionInterface;
use Illuminate\Database\ConnectionResolverInterface;

class ConnectionResolver implements ConnectionResolverInterface
{
    /**
     * Default connection name.
     *
     * @var string
     */
    protected $default = 'wpdb';

    /**
     * Connection instance.
     *
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get a database connection instance.
     *
     * @param string|null $name
     *
     * @return ConnectionInterface
     */
    public function connection($name = null): ConnectionInterface
    {
        return $this->connection;
    }

    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultConnection(): string
    {
        return $this->default;
    }

    /**
     * Set the default connection name.
     *
     * @param string $name
     * @return void
     */
    public function setDefaultConnection($name)
    {
        throw AttemptToChangeDefaultConnectionException::byConnectionName($name, $this->default);
    }
}