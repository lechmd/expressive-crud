<?php

namespace App\Action\User;

use App\Service\UserServiceInterface;
use Interop\Container\ContainerInterface;

class DeleteActionFactory
{
    /**
     * @param ContainerInterface $container
     * @return DeleteAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $userService = $container->get(UserServiceInterface::class);

        return new DeleteAction($userService);
    }
}

