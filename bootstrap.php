<?php

require_once __DIR__ . '/vendor/autoload.php';
$configure = require_once __DIR__ . '/factory.php';

$serviceManager = new \Zend\ServiceManager\ServiceManager();
$serviceManager->setService(
    'config',
    \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . '/config.yaml'))
);
$serviceManager->configure($configure);

return $serviceManager;
