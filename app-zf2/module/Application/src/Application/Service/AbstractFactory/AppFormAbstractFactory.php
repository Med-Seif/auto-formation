<?php

/**
 * Description of FormAbstractFactory
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Service\AbstractFactory;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AppFormAbstractFactory implements AbstractFactoryInterface {

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {

        if (class_exists("Application\Form\\" . $requestedName . 'Form')) {
            return true;
        }
        return false;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        $class = "Application\Form\\" . $requestedName . 'Form';
        return new $class($serviceLocator->get('Doctrine\ORM\EntityManager'));
    }

}
