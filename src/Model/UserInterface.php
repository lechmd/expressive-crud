<?php

namespace App\Model;

interface UserInterface extends EntityInterface
{
    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string $username
     * @return self
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return self
     */
    public function setEmail($email);
}

