<?php

namespace Application\Form;

use Zend\Form\Factory;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Application\Entity\Supplier;

class SupplierForm {

    private static $_instance;

    public static function getForm() {
        $factory = new Factory();
        $form    = $factory->createForm(
                array(
                    'elements'     => array(
                        array(
                            'spec' => array(
                                'name'       => 'label',
                                'options'    => array(
                                    'label' => 'Label',
                                ),
                                'attributes' => array('class' => 'form-control'),
                                'type'       => 'Text',
                            )
                        ),
                        array(
                            'spec' => array(
                                'name'       => 'email',
                                'options'    => array(
                                    'label' => 'Email',
                                ),
                                'attributes' => array('class' => 'form-control'),
                                'type'       => 'Zend\Form\Element\Email',
                            ),
                        ),
                        array(
                            'spec' => array(
                                'name'       => 'submit',
                                'type'       => 'Submit',
                                'attributes' => array(
                                    'value' => 'Save',
                                    'id'    => 'submitbutton',
                                    'class' => 'btn btn-primary',
                                ),
                            )
                        )
                    ),
                    'input_filter' => array(
                        'label' => array(
                            'filters' => array(
                                array('name' => 'StripTags'),
                                array('name' => 'StringTrim')
                            )
                        )
                    )
                )
        );
        $form->setHydrator(new ClassMethodsHydrator(false));
        return $form;
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = self::getForm();
        }
        return self::$_instance;
    }

}
