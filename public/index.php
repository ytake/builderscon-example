<?php
/** @var \Zend\ServiceManager\ServiceManager $serviceManager */
$serviceManager = require_once __DIR__ . '/../bootstrap.php';

$serverRequest = Zend\Diactoros\ServerRequestFactory::fromGlobals();
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->get('/', \Ytake\Builderscon\Action\ReadAction::class);
});
$uri = $serverRequest->getUri();
$routeInfo = $dispatcher->dispatch($serverRequest->getMethod(), $uri->getPath());
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::FOUND:
        $action = $serviceManager->get($routeInfo[1]);

        return $action($serverRequest);
    default:
        return;
}
