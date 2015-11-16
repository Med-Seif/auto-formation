<?php

/**
 * Description of AppForm
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Application\Form\CustomerForm;

class CustomerFormFactory implements FactoryInterface {

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $em       = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $instance = new CustomerForm($em);
        return $instance;
    }

}
