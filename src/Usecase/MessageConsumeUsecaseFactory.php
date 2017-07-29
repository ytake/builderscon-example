<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Usecase;

use Interop\Container\ContainerInterface;
use Ytake\Builderscon\Consumer\Consumer;
use Ytake\Builderscon\Foundation\ConfigRepository;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MessageConsumeUsecaseFactory
 */
class MessageConsumeUsecaseFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return MessageConsumeUsecase
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): MessageConsumeUsecase {
        return new MessageConsumeUsecase(
            new Consumer(new ConfigRepository($container->get('config')))
        );
    }
}
