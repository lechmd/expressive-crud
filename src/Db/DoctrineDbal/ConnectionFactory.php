<?php

namespace App\Db\DoctrineDbal;

use Doctrine\DBAL\DriverManager;
use Interop\Container\ContainerInterface;

class ConnectionFactory
{
    /**
     * @param ContainerInterface $container
     * @return \Doctrine\DBAL\Connection
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $connection = DriverManager::getConnection($config['database']);

        return $connection;
    }
}

