<?php

namespace User\Form;

use Zend\Form\Element\Email;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Form;

/**
 * Class LoginForm
 * @package User\Form
 */
class LoginForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('login');
        $this->add([
            'name' => 'email',
            'type' => Email::class,
            'options'  => [
                'label'=> 'Email de usuário'
            ],
            'attributes'   => [
                'required' => true,
                'class'    => 'form-control',
            ]
        ]);
        $this->add([
            'name' => 'password',
            'type' => Password::class,
            'options'   => [
                'label' => 'Senha'
            ],
            'attributes'   => [
                'required' => true,
                'class'    => 'form-control'
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes'=> [
                'value' => 'Logar',
                'class' => 'btn btn-primary form-control',
                'id'    => 'submit'
            ]
        ]);
    }
}