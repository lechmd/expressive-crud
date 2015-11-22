<?php

namespace App\Mapper\DoctrineDbal;

use App\Mapper\UserMapperInterface;
use App\Model\User;

class UserMapper extends AbstractMapper implements UserMapperInterface
{
    /**
     * @var string $tableName
     */
    protected $tableName = 'users';

    /**
     * @param array $userRow
     * @return \App\Model\UserInterface
     */
    public function createEntity(array $userRow)
    {
        $userEntity = new User(
            $userRow['username'],
            $userRow['email']
        );
        $userEntity->setId($userRow['id']);

        return $userEntity;
    }
}

