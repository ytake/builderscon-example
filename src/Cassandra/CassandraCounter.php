<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Cassandra;

use Cassandra\ExecutionOptions;
use Cassandra\Session;
use Cassandra\SimpleStatement;
use Ytake\Builderscon\Foundation\Cassandra\ConnectionConfigure;

/**
 * Class CassandraCounter
 */
class CassandraCounter
{
    /** @var ConnectionConfigure */
    protected $connectionConfigure;

    /**
     * CassandraCounter constructor.
     *
     * @param ConnectionConfigure $connectionConfigure
     */
    public function __construct(ConnectionConfigure $connectionConfigure)
    {
        $this->connectionConfigure = $connectionConfigure;
    }

    /**
     * @param string $order
     *
     * @return mixed
     */
    public function allStreams(string $order = 'desc')
    {
        $cluster = \Cassandra::cluster()
            ->withContactPoints($this->connectionConfigure->host())->build();
        $session = $cluster->connect($this->connectionConfigure->keyspace());
        $query = 'SELECT * FROM builderscon.counter_desc WHERE stream = ?';
        if ($order === 'asc') {
            $query = 'SELECT * FROM builderscon.counter_asc WHERE stream = ?';
        }
        $statement = new SimpleStatement($query);
        $options = new ExecutionOptions([
            'arguments' => [
                'spark',
            ],
        ]);

        return $session->execute($statement, $options);
    }
}
