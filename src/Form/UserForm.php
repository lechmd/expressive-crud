<?php

namespace App\Form;

use App\Validation\UserValidator;
use Zend\Form\Form as ZendForm;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class UserForm extends ZendForm implements InputFilterProviderInterface
{
    /**
     * @param null|string $name
     */
    public function __construct($name = null)
    {
        $name = isset($name) ? $name : 'user-form';
        parent::__construct($name);

        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator());

        $this->add([
            'name' => 'id',
            'type'  => 'hidden',
        ]);
        $this->add([
            'name' => 'username',
            'type'  => 'text',
            'options' => [
                'label' => 'Username',
            ],
            'attributes' => [
                'placeholder' => 'Username',
            ],
        ]);
        $this->add([
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => [
                'label' => 'Email',
            ],
            'attributes' => [
                'placeholder' => 'Email',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type'  => 'Submit',
            'attributes' => [
                'value' => 'Save',
            ],
        ]);
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        $userValidator = new UserValidator();

        return [
            'username' => [
                'required' => true,
                'filters'  => [
                    ['name' => 'Zend\Filter\StringTrim'],
                ],
                'validators' => [
                    $userValidator->getValidator('username')
                ]
            ],
            'email' => [
                'required' => true,
                'filters'  => [
                    ['name' => 'Zend\Filter\StringTrim'],
                ],
                'validators' => [
                    $userValidator->getValidator('email')
                ],
            ],
        ];
    }
}

