<?php

return [
    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\HomeAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'user-list',
            'path' => '/user-list',
            'middleware' => App\Action\UserListAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'user-add',
            'path' => '/user-add',
            'middleware' => App\Action\UserAddAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'user-edit',
            'path' => '/user-edit[/{id:\d+}]',
            'middleware' => App\Action\UserEditAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'user-delete',
            'path' => '/user-delete',
            'middleware' => App\Action\UserDeleteAction::class,
            'allowed_methods' => ['POST'],
        ],
    ],
];

