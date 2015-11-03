<?php

namespace Application\Form\Fieldset;

use Application\Entity\Customer;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class CustomerFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('customer');
        $this
                ->setHydrator(new ClassMethodsHydrator(false))
                ->setObject(new Customer());

        $this->add(array(
            'name'       => 'label',
            'type'       => 'Text',
            'options'    => array(
                'label' => 'Label',
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        $this->add(array(
            'name'       => 'address',
            'type'       => 'Text',
            'options'    => array(
                'label' => 'Address',
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        $this->add(array(
            'name'       => 'country',
            'type'       => 'DoctrineModule\Form\Element\ObjectSelect',
            'options'    => array(
                'label'              => 'Country',
                //'object_manager' => $this->em,
                'target_class'       => 'Application\Entity\Country',
                'property'           => 'label',
                'is_method'          => true,
                'display_empty_item' => true,
                'empty_item_label'   => '--Country--',
                'find_method'        => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy'  => array('label' => 'ASC'),
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        $this->add(array(
            'name'       => 'date',
            'type'       => 'text',
            'options'    => array(
                'label' => 'First transaction date',
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        $this->add(array(
            'name'       => 'submit',
            'type'       => 'Submit',
            'attributes' => array(
                'value' => 'Save',
                'id'    => 'submitbutton',
                'class' => 'btn btn-warning',
            ),
        ));
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification() {
        return array();
    }

}
