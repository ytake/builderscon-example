<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Payload;

use Ytake\Builderscon\Cassandra\CassandraCounter;

/**
 * Class StreamPayload
 */
class StreamPayload
{
    /** @var CassandraCounter */
    protected $cassandraCounter;

    /**
     * StreamPayload constructor.
     *
     * @param CassandraCounter $cassandraCounter
     */
    public function __construct(CassandraCounter $cassandraCounter)
    {
        $this->cassandraCounter = $cassandraCounter;
    }

    /**
     * @return array
     */
    public function payload(): array
    {
        $result = [];
        foreach ($this->cassandraCounter->allStreams() as $row) {
            $result[] = $row;
        }

        return $result;
    }
}
