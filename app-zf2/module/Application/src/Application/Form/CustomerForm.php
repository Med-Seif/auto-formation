<?php

/**
 * Description of Customer
 *
 * @author Seif
 */

namespace Application\Form;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class CustomerForm extends Form {
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct('customer');
        $hydrator = new DoctrineHydrator($em, 'Application\Entity\Country'); // in order to read country field as objet Country
        $this->setHydrator($hydrator);
        $this->add(array(
            'name'       => 'label',
            'type'       => 'Text',
            'options'    => array(
                'label' => 'Label',
            ),
            'attributes' => array(
                'class' => 'form-control',
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
                'object_manager'     => $em,
                'target_class'       => 'Application\Entity\Country',
                'property'           => 'label',
                'is_method'          => true,
                'display_empty_item' => true,
                'empty_item_label'   => '',
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
                'label' => 'Date première transaction',
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
                'class' => 'btn btn-primary',
            ),
        ));
    }

}
