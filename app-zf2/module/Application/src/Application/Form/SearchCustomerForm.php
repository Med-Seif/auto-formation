<?php

/**
 * Description of SearchCustomerForm
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class SearchCustomerForm extends Form {

    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct('searchCustomerForm');
        $this->em = $em;
        $this
                ->setAttribute('method', 'get')
                ->setHydrator(new ClassMethodsHydrator(false))
                ->setInputFilter(new InputFilter());
        $this->add(array(
            'type'    => 'Application\Form\Fieldset\CustomerFieldset',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));

        $this->add(array(
            'name'       => 'submit',
            'type'       => 'Submit',
            'attributes' => array(
                'value' => 'Search',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary',
            ),
        ));
        $labelLabel = $this->get('customer')->get('label')->getLabel();
        $this->get('customer')->get('label')->setAttribute('placeholder', $labelLabel);

        $labelDate = $this->get('customer')->get('date')->getLabel();
        $this->get('customer')->get('date')->setAttribute('placeholder', $labelDate);

        $labelAddress = $this->get('customer')->get('address')->getLabel();
        $this->get('customer')->get('address')->setAttribute('placeholder', $labelAddress);

        $this->get('customer')->get('country')->getProxy()->setObjectmanager($this->em);

        $this->get('customer')->get('country')->getProxy()->setObjectmanager($this->em);

        $this->setAttribute('data-ng-submit', 'validateForm($event)');
        $this->setAttribute('class', 'form-inline');

    }
}
