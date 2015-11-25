<?php

/**
 * Description of AppInitializer
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Service\Initializer;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\InitializerInterface;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;

class ObjectManagerInjectorInitializer implements InitializerInterface {

    public function initialize($instance, ServiceLocatorInterface $serviceLocator) {
        if ($instance instanceof ObjectManagerAwareInterface) {
            $em = $serviceLocator->get('Doctrine\ORM\EntityManager');
            $instance->setObjectManager($em);
            return $instance;
        }
    }

}
