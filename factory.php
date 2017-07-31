<?php

return [
    'factories'  => [
        \Ytake\Builderscon\Console\ProducerConsole::class       =>
            \Ytake\Builderscon\Console\ProducerConsoleFactory::class,
        \Ytake\Builderscon\Console\ConsumerConsole::class       =>
            \Ytake\Builderscon\Console\ConsumerConsoleFactory::class,
        \Ytake\Builderscon\Usecase\MessageProduceUsecase::class =>
            \Ytake\Builderscon\Usecase\MessageProduceUsecaseFactory::class,
        \Ytake\Builderscon\Usecase\MessageConsumeUsecase::class =>
            \Ytake\Builderscon\Usecase\MessageConsumeUsecaseFactory::class,
        \Ytake\Builderscon\Action\ReadAction::class             =>
            \Ytake\Builderscon\Action\ReadActionFactory::class,
    ],
    'invokables' => [

    ],
    'aliases'    => [

    ],
];
