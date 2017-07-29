<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Consumer;

use RdKafka\Message;

/**
 * Interface Consumable
 */
interface Consumable
{
    /**
     * @param Message $message
     *
     * @return mixed
     */
    public function __invoke(Message $message);
}
