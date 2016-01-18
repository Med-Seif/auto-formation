<?php

namespace Admin\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

Class UserForm {
    /**
     *
     * @var Zend\Form\Form
     */
    private static $form;
    /**
     *
     * @return Zend\Form\Form
     */
    public static function getInstance() {
        if (!self::$form) {
            self::$form = self::getForm();
        }
        return self::$form;
    }

    private static function getForm() {
        $username = new Element\Text('username');
        $username->setLabel("Username")->setAttribute('class', 'form-control');
        $email    = new Element\Email('email');
        $email->setLabel("Email")->setAttribute('class', 'form-control');
        $role     = new Element\Select('role');
        $role->setLabel("Role")->setAttribute('class', 'form-control');
        $role->setOptions(array(
            'value_options' => array(1 => 'Administrator', 2 => 'Manager', 3 => 'Supervisor', 4 => 'Visitor'),
            'empty_option'  => '---Select an item---'));
        $password = new Element\Password('password');
        $password->setLabel("Password")->setAttribute('class', 'form-control');
        $csrf     = new Element\Csrf('csrf');
        $submit   = new Element\Submit('submit');
        $submit->setValue('Submit')->setAttribute("class", "btn btn-default");

        $form = new Form('user');
        $form->add($username);
        $form->add($email);
        $form->add($role);
        $form->add($password);
        $form->add($csrf);
        $form->add($submit);
        $filter = self::getInputFilter();
        $form->setInputFilter($filter);
        $form->setAttribute('novalidate', true);
        return $form;
    }

    private static function getInputFilter() {
        $inputFilter = new InputFilter();
        $inputFilter->add(
                array(
                    'name'       => 'username',
                    'required'   => true,
                    'filters'    => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')),
                    'validators' => array(
                        array(
                            'name' => 'Alnum'
                        ),
                    ),
        ));
        $inputFilter->add(
                array(
                    'name'     => 'email',
                    'required' => true,
                    'filters'  => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')),
        ));
        return $inputFilter;
    }

}
