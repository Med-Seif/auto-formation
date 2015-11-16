<?php

/**
 * Description of LoginForm
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class LoginForm extends Form {

    public function __construct() {
        parent::__construct('loginForm');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'type'    => 'Application\Form\Fieldset\LoginFieldset',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ));
        $this->add(array(
            'name'       => 'submit',
            'type'       => 'Submit',
            'attributes' => array(
                'value' => 'Enter',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary',
            ),
        ));
    }

}
