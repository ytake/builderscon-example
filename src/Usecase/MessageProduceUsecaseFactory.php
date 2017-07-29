<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Usecase;

use Interop\Container\ContainerInterface;
use Ytake\Builderscon\Foundation\ConfigRepository;
use Ytake\Builderscon\Producer\Producer;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MessageProduceUsecaseFactory
 */
class MessageProduceUsecaseFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return MessageProduceUsecase
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): MessageProduceUsecase {
        return new MessageProduceUsecase(
            new Producer(new ConfigRepository($container->get('config')))
        );
    }
}
