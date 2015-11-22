<?php

namespace App\Model;

use App\Exception\EntityIdAlreadySetException;
use App\Validation\UserValidator;

class User implements UserInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * @param string $username
     * @param string $email
     */
    public function __construct($username, $email)
    {
        $this->validator = new UserValidator();
        $this->setUsername($username);
        $this->setEmail($email);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     * @throws EntityIdAlreadySetException if id property is already set
     */
    public function setId($id)
    {
        if (isset($this->id) && $this->id !== $id) {
            throw new EntityIdAlreadySetException("User id already set");
        }
        $this->validator->assertId($id);
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return self
     */
    public function setUsername($username)
    {
        $this->validator->assertUsername($username);
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->validator->assertEmail($email);
        $this->email = $email;

        return $this;
    }
}

