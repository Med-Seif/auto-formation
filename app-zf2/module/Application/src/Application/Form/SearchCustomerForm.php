<?php

/**
 * Description of SearchCustomerForm
 *
 * @author Med_Seif <bromdhane@gail.com>
 */
class SearchCustomerForm {
    public function __construct() {
        parent::__construct('search-customer');
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
                'label'          => 'Country',
                'object_manager' => $this->em,
                'target_class'   => 'Application\Entity\Country',
                'property'       => 'label',
                'is_method'      => true,
                'find_method'    => array(
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
                'class' => 'btn btn-warning',
            ),
        ));
    }

}
