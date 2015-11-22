<?php

return [
    'dependencies' => [
        'invokables' => [
            'Zend\Expressive\Router\RouterInterface' => 'Zend\Expressive\Router\FastRouteRouter',
        ],
        'factories' => [
            'App\Action\HomeAction' => 'App\Action\HomeActionFactory',
            'App\Action\User\AddAction' => 'App\Action\User\AddActionFactory',
            'App\Action\User\DeleteAction' => 'App\Action\User\DeleteActionFactory',
            'App\Action\User\EditAction' => 'App\Action\User\EditActionFactory',
            'App\Action\User\ListAction' => 'App\Action\User\ListActionFactory',
            'App\Mapper\User\MapperInterface' => 'App\Mapper\DoctrineDbal\UserMapperFactory',
            'App\Service\UserServiceInterface' => 'App\Service\UserServiceFactory',
            'Doctrine\DBAL\Connection' => 'App\Db\DoctrineDbal\ConnectionFactory',
            'Zend\Expressive\Application' => 'Zend\Expressive\Container\ApplicationFactory',
            'Zend\Expressive\FinalHandler' => 'Zend\Expressive\Container\TemplatedErrorHandlerFactory',
            'Zend\Expressive\Template\TemplateRendererInterface' => 'Zend\Expressive\Plates\PlatesRendererFactory',
        ]
    ]
];

