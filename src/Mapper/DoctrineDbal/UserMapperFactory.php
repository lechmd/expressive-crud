<?php

namespace App\Mapper\DoctrineDbal;

use App\Mapper\DoctrineDbal\UserMapper;
use Doctrine\DBAL\Connection;
use Interop\Container\ContainerInterface;

class UserMapperFactory
{
    /**
     * @param ContainerInterface $container
     * @return \App\Mapper\UserMapperInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        $db = $container->get(Connection::class);

        return new UserMapper($db);
    }
}

