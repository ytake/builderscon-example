<?php

namespace Ytake\Builderscon;

use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\Response;

/**
 * Class Action
 */
class Action
{
    /**
     * @param RequestInterface $request
     */
    public function __invoke(RequestInterface $request)
    {
        $response = new Response\JsonResponse(['message' => 'hello builderscon']);
        $emitter = new \Zend\Diactoros\Response\SapiEmitter();
        $emitter->emit($response);
    }
}
