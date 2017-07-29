<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Foundation\Transfer;

/**
 * Class ProduceTransfer
 */
final class ProducerTransfer
{
    /** @var string */
    private $topic;

    /**
     * @param string $topic
     */
    public function setTopic(string $topic)
    {
        $this->topic = $topic;
    }

    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->topic;
    }
}
