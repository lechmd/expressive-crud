<?php

namespace App\Service;

use App\Mapper\UserMapperInterface;
use Interop\Container\ContainerInterface;

class UserServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return \App\Service\UserServiceInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        $userMapper = $container->get(UserMapperInterface::class);

        return new UserService($userMapper);
    }
}

