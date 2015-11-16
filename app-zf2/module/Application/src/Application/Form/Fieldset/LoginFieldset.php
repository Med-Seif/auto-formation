<?php

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class LoginFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('login');

        $this->add(array(
            'name'       => 'username',
            'type'       => 'Zend\Form\Element\Text',
            'options'    => array(
                'label' => 'Username',
            ),
            'attributes' => array(
                'id'            => 'username',
                'class'         => 'form-control',
                'data-ng-model' => 'username',
            )
        ));
        $this->add(array(
            'name'       => 'password',
            'type'       => 'Zend\Form\Element\Password',
            'options'    => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'id'            => 'password',
                'class'         => 'form-control',
                'data-ng-model' => 'password',
            )
        ));
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification() {
        return array(
            'username'    => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                )
            ),
            'password' => array(
                'required' => true,
                array('name' => 'StripTags'),
                array('name' => 'StringTrim')
            )
        );
    }

}
