<?php
declare(strict_types=1);

namespace Ytake\Builderscon\Action;

use Psr\Http\Message\RequestInterface;
use Ytake\Builderscon\Payload\StreamPayload;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;

/**
 * Class ReadAction
 */
final class ReadAction
{
    /** @var StreamPayload */
    private $payload;

    /**
     * ReadAction constructor.
     *
     * @param StreamPayload $payload
     */
    public function __construct(StreamPayload $payload)
    {
        $this->payload = $payload;
    }

    /**
     * @param RequestInterface $request
     */
    public function __invoke(RequestInterface $request)
    {
        $emitter = new SapiEmitter();
        $emitter->emit(new Response\JsonResponse($this->payload->payload()));
    }
}
