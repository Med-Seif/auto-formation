<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController {

    public function getAdapter() {
        if (!$this->adapter) {
            $sm            = $this->getServiceLocator();
            $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
        }
        return $this->adapter;
    }

    protected $userService;

    public function indexAction() {
        $users = $this->getServiceLocator()->get('Admin\Model\UserTable')->fetchAll();
        return array('users' => $users);
    }

    public function connectedAction() {
        $service = $this->getServiceLocator()->get('UserService');
        $users   = $service->getConnectedUsers();
        return array('users' => $users);
    }

}
