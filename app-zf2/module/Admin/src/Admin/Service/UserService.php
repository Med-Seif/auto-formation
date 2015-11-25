<?php

/**
 * Description of User
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Admin\Service;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Admin\Model\UserTable;

class UserService implements ObjectManagerAwareInterface {

    private $objectManager;

    public function __construct() {

    }

    public function getAll() {
        return $this->objectManager->getRepository('Application\Entity\User')->findAll();
    }

    public function isConnectedUser($id) {
        return $this->objectManager->getRepository('Application\Entity\User')->isConnected($id);
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
