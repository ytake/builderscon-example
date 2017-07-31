<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Action;

use Interop\Container\ContainerInterface;
use Ytake\Builderscon\Cassandra\CassandraCounter;
use Ytake\Builderscon\Foundation\Cassandra\ConnectionConfigure;
use Ytake\Builderscon\Payload\StreamPayload;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ReadActionFactory
 */
final class ReadActionFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return ReadAction
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config')['cassandra'];
        $connectionConfig = new ConnectionConfigure($config['host'], $config['keyspace']);

        return new ReadAction(new StreamPayload(new CassandraCounter($connectionConfig)));
    }
}
