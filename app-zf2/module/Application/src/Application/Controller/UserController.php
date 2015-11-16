<?php

/**
 * Description of UserController
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractActionController {

    protected $userService;

    public function indexAction() {

    }

    public function connectedAction() {
        $service = $this->getServiceLocator()->get('UserService');
        $users   = $service->getConnectedUsers();
        return array('users' => $users);
    }

}
