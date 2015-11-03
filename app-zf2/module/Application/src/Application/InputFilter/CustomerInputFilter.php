<?php

/**
 * Description of CustomerInputFilter
 *
 * @author Seif
 */

namespace Application\InputFilter;

use Zend\InputFilter\InputFilter;
use Doctrine\ORM\EntityManager;
use Application\Entity\Customer;

class CustomerInputFilter extends InputFilter {

    private static $_inputFilter;
    public static $em;

    public static function getInstance(EntityManager $em = null, Customer $customer = null) {
        if (self::$_inputFilter) {
            return self::$_inputFilter;
        }
        if ($em) {
            self::$em = $em;
        }
        $inputFilter = new InputFilter();
        $inputFilter->add(
                array(
                    'name'       => 'label',
                    'required'   => true,
                    'filters'    => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 45,
                            ),
                        ),
                        array(
                            'name'    => '\Application\Validator\DbUniqueObject',
                            'options' => array(
                                'em'         => self::$em,
                                'entity'     => 'Application\Entity\Customer',
                                'field'      => 'label',
                                'exclude_id' => ($customer) ? $customer->getID() : null,
                            )
                        )
                    ),
        ));
        $inputFilter->add(
                array(
                    'name'       => 'address',
                    'required'   => true,
                    'filters'    => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 45,
                            ),
                        ),
                    ),
        ));
        $inputFilter->add(
                array(
                    'name'       => 'country',
                    'required'   => true,
                    'filters'    => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 45,
                            ),
                        ),
                    ),
        ));
        $inputFilter->add(
                array(
                    'name'     => 'date',
                    'required' => false,
                    'filters'  => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                        /*
                        array('name'    => 'callback', 'options' =>
                            array('callback' => function($value) {
                                    if (!is_null($value)) {
                                        $value = \DateTime::createFromFormat('d/m/Y', $value);
                                        return $value->format('m/d/Y');
                                    }
                                    return $value;
                                },
                            )
                        )*/
                    ),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 45,
                            ),
                        ),
                        array(
                            'name'    => 'Date',
                            'options' => array(
                                'format' => 'd/m/Y'
                            )
                        )
                    ),
        ));
        self::$_inputFilter = $inputFilter;
        return $inputFilter;
    }

}
