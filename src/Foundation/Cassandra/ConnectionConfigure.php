<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Foundation\Cassandra;

/**
 * Class ConnectionConfigure
 */
final class ConnectionConfigure
{
    /** @var string */
    private $host;

    /** @var string */
    private $keySpace;

    /**
     * Connection constructor.
     *
     * @param string $host
     * @param string $keySpace
     */
    public function __construct(string $host, string $keySpace)
    {
        $this->host = $host;
        $this->keySpace = $keySpace;
    }

    /**
     * @return string
     */
    public function host(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function keyspace(): string
    {
        return $this->keySpace;
    }
}
