<?php

namespace Application\Form\Fieldset;

use Application\Entity\Product;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class ProductFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('product');
        $this
                ->setHydrator(new ClassMethodsHydrator(false))
                ->setObject(new Product());

        $this->add(array(
            'name'       => 'label',
            'options'    => array(
                'label' => 'Label',
            ),
            'attributes' => array(
                'required' => 'required',
                'class'    => 'form-control'
            ),
        ));

        $this->add(array(
            'name'       => 'price',
            'options'    => array(
                'label' => 'Price',
            ),
            'attributes' => array(
                'required' => 'required',
                'class'    => 'form-control'
            ),
        ));
        $this->add(array(
            'name'       => 'supplier',
            'type'       => 'DoctrineModule\Form\Element\ObjectSelect',
            'options'    => array(
                'label'        => 'Supplier',
                'target_class' => 'Application\Entity\Supplier',
                'property'     => 'label',
                'find_method'  => array(
                    'name' => 'findAll'
                )
            ),
            'attributes' => array(
                'required' => 'required',
                'class'    => 'form-control'
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
        return array(
            'label'    => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                )
            ),
            'price'    => array(
                'required'   => true,
                'validators' => array(
                    array(
                        'name' => 'Float'
                    )
                )
            ),
            'supplier' => array('required' => true)
        );
    }

}
