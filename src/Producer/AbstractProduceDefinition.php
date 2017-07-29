<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Producer;

/**
 * Class AbstractProduceDefinition
 */
abstract class AbstractProduceDefinition
{
    /**
     * @return string
     */
    abstract public function message(): string;

    /**
     * @return string
     */
    public function payload()
    {
        return json_encode(['message' => $this->message()]);
    }
}
