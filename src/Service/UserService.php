<?php

namespace App\Service;

use App\Exception\UserNotFoundException;
use App\Mapper\UserMapperInterface;
use App\Model\UserInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserMapperInterface
     */
    protected $userMapper;

    /**
     * @param UserMapperInterface $userMapper
     */
    public function __construct(UserMapperInterface $userMapper)
    {
        $this->userMapper = $userMapper;
    }

    /**
     * @param int $id
     * @return UserInterface
     * @throws UserNotFoundException if user with provided id doesn't exist
     */
    public function findById($id)
    {
        $user = $this->userMapper->find($id);
        if (!$user) {
            throw new UserNotFoundException('Couldn\'t find user with id: ' . $id);
        }

        return $user;
    }

    /**
     * @return UserInterface[]
     */
    public function findAll()
    {
        return $this->userMapper->findAll();
    }

    /**
     * @param UserInterface $user
     * @return UserInterface
     */
    public function save(UserInterface $user)
    {
        return $this->userMapper->save($user);
    }

    /**
     * @param UserInterface $user
     * @return bool
     */
    public function delete(UserInterface $user)
    {
        return $this->userMapper->delete($user);
    }

    /**
     * @return array
     */
    public function findAllForView()
    {
        $result = [];
        $users = $this->findAll();
        foreach ($users as $user) {
            $result[] = $user->toArray();
        }
        return $result;
    }
}

