<?php

namespace App\Validation;

use Zend\Validator;

class UserValidator extends AbstractValidator
{
    public function __construct()
    {
        // Id
        $idValidator = new Validator\ValidatorChain();
        $idValidator
            ->attach(new Validator\Digits())
            ->attach(new Validator\GreaterThan(['min' => 1]));
        $this->addValidator('id', $idValidator);

        // Username
        $usernameValidator = new Validator\ValidatorChain();
        $usernameValidator
            ->attach(new Validator\NotEmpty([
                'message' => 'Username is required',
            ]))
            ->attach(new Validator\StringLength([
                'min' => 4,
                'max' => 16,
                'messages' => [
                    Validator\StringLength::TOO_SHORT => 'Username must have at least 4 characters',
                    Validator\StringLength::TOO_LONG  => 'Username can\'t have more than 16 characters',
                ],
            ]))
        ;
        $this->addValidator('username', $usernameValidator);

        // Email
        $emailValidator = new Validator\ValidatorChain();
        $emailValidator
            ->attach(new Validator\NotEmpty([
                'message' => 'Email address is required',
            ]))
            ->attach(new Validator\EmailAddress([
                'message' => 'Invalid email format',
            ]))
        ;
        $this->addValidator('email', $emailValidator);
    }

    /**
     * @param string $key
     * @return \Zend\Validator\ValidatorInterface|null
     */
    public function getValidator($key)
    {
        return isset($this->validators[$key]) ? $this->validators[$key] : null;
    }

    /**
     * @param int $id
     */
    public function assertId($id)
    {
        $this->assert('id', $id);
    }

    /**
     * @param string $username
     */
    public function assertUsername($username)
    {
        $this->assert('username', $username);
    }

    /**
     * @param string $email
     */
    public function assertEmail($email)
    {
        $this->assert('email', $email);
    }
}

