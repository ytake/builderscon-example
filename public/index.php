<?php
/** @var \Zend\ServiceManager\ServiceManager $serviceManager */
$serviceManager = require_once __DIR__ . '/../bootstrap.php';

$serverRequest = Zend\Diactoros\ServerRequestFactory::fromGlobals();
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->get('/', Ytake\Builderscon\Action::class);
});
$uri = $serverRequest->getUri();
$routeInfo = $dispatcher->dispatch($serverRequest->getMethod(), $uri->getPath());
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $action = new $routeInfo[1];
        return $action($serverRequest);
}

