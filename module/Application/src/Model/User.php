<?php
namespace Application\Model;

use Zend\InputFilter\InputFilter;

class User
{
    public $id;
    public $email;
    public $password;

    /**
     * Configura os filtros dos campos da classe
     *
     * @return Zend\InputFilter\InputFilter
     */
    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add(array(
            'name'     => 'id',
            'required' => false,
            'filters'  => array(
                array('name' => 'Int'),
            ),
        ));

        $inputFilter->add(array(
            'name'     => 'email',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 160,
                    ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name'     => 'password',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 160,
                    ),
                ),
            ),
        ));

        return $inputFilter;
    }
}
