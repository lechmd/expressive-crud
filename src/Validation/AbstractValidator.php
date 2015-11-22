<?php

namespace App\Validation;

use App\Exception\AssertException;

abstract class AbstractValidator
{
    /**
     * @var \Zend\Validator\ValidatorInterface[]
     */
    protected $validators = [];

    /**
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    protected function validate($key, $value)
    {
        if (isset($this->validators[$key])) {
            return $this->validators[$key]->isValid($value);
        }
        return true;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @throws AssertException if validation fails
     */
    protected function assert($key, $value)
    {
        if (isset($this->validators[$key])
            && !$this->validators[$key]->isValid($value)
        ) {
            throw new AssertException(
                '\'' . $value . '\' is not a valid ' . $key . ' value.'
            );
        }
    }

    /**
     * @param string $key
     * @param \Zend\Validator\ValidatorInterface $validator
     */
    protected function addValidator($key, $validator)
    {
        $this->validators[$key] = $validator;
    }
}

