<?php

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class Login extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name' => 'email',
            'options' => [
                'label' => 'E-mail',
            ],
            'type'  => 'Email',
        ]);

        $this->add([
            'name' => 'password',
            'options' => [
                'label' => 'Password',
            ],
            'type'  => 'Password',
        ]);

        $this->add([
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => [
                'value' => 'Log in',
            ],
        ]);

        $this->setAttribute('action', '/auth/login');
        $this->setAttribute('method', 'post');
    }
}
