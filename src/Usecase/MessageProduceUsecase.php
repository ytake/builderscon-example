<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Usecase;

use Ytake\Builderscon\Foundation\Transfer\ProducerTransfer;
use Ytake\Builderscon\Producer\Producer;
use Ytake\Builderscon\Producer\AbstractProduceDefinition;

/**
 * Class MessageProduceUsecase
 */
class MessageProduceUsecase
{
    /** @var Producer */
    protected $producer;

    /**
     * MessageProduceUsecase constructor.
     *
     * @param Producer $producer
     */
    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param ProducerTransfer          $transfer
     * @param AbstractProduceDefinition $definition
     */
    public function execute(ProducerTransfer $transfer, AbstractProduceDefinition $definition)
    {
        $this->producer->topic($transfer->getTopic());
        $this->producer->produce($definition);
    }
}
