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
use Admin\Form\UserForm;
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
        $route = $this->getEvent()->getRouteMatch(); // getEvent() returns MvcEvent
        var_dump($route->getParams());
        echo $this->generator();
        $users = $this->getServiceLocator()->get('Admin\Model\UserTable')->fetchAll();
        return array('users' => $users);
    }

    public function addAction() {
        $form    = UserForm::getInstance();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $userTable = $this->getServiceLocator()->get('Admin\Model\UserTable');
                $data      = $form->getData();
                $user      = new \Admin\Model\User();
                $user->exchangeArray($data);
                if ($userTable->saveUser($user)) {
                    $this->flashMessenger()->addSuccessMessage($form->getData()['email'] . " was successfully inserted to database");
                    return $this->redirect()->toRoute('user');
                }
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $id        = $this->params()->fromRoute('id');
        $userTable = $this->getServiceLocator()->get('Admin\Model\UserTable');
        $user      = $userTable->getUser($id);
        $form      = UserForm::getInstance();
        $form->bind($user); // you have to implement getArrayCopy in User class, if not you will get this error : Zend\Stdlib\Hydrator\ArraySerializable::extract expects the provided object to implement getArrayCopy()
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data       = $form->getData();
                $data->id = $data;
                if ($userTable->saveUser($data)) {
                    $this->flashMessenger()->addSuccessMessage($data->email . " was successfully edited");
                    return $this->redirect()->toRoute('user');
                }
            }
        }
        return array('form' => $form, 'id' => $id);
    }

    public function deleteAction() {
        $id        = $this->params()->fromRoute('id');
        $user      = new \Admin\Model\User();
        $userTable = $this->getServiceLocator()->get('Admin\Model\UserTable');
        $user      = $userTable->getUser($id);
    }

    public function connectedAction() {
        $service = $this->getServiceLocator()->get('UserService');
        $users   = $service->getConnectedUsers();
        return array('users' => $users);
    }

}
