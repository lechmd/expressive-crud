<?php

namespace App\Service;

use App\Model\UserInterface;

interface UserServiceInterface
{
    /**
     * @param int $id
     * @return UserInterface
     * @throws UserNotFoundException if user with provided id doesn't exist
     */
    public function findById($id);

    /**
     * @return UserInterface[]
     */

    public function findAll();
    /**
     * @param UserInterface $user
     * @return UserInterface
     */
    public function save(UserInterface $user);

    /**
     * @param UserInterface $user
     * @return bool
     */
    public function delete(UserInterface $user);

    /**
     * @return array
     */
    public function findAllForView();
}

