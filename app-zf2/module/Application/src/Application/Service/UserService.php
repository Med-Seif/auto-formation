<?php

/**
 * Description of User
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Service;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Application\Entity\User;

class UserService implements ObjectManagerAwareInterface {

    private $objectManager;

    public function __construct() {

    }

    public function isConnectedUser($id) {

    }

    public function getConnectedUsers() {
        return $this->objectManager->getRepository('Application\Entity\User')->getConnected();
    }

    public function getObjectManager() {
        return $this->objectManager;
    }

    public function setObjectManager(\Doctrine\Common\Persistence\ObjectManager $objectManager) {
        $this->objectManager = $objectManager;
    }

}
