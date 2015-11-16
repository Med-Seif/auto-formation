<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Zend\View\Model\ViewModel;
use Application\Auth\Adapter;
use Application\Auth\Storage;
use Application\Form\LoginForm;

class AuthController extends AbstractActionController {

    protected $em;
    protected $auth;

    public function checkIdentity() {
        if ($this->getAuth()->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function getAuth() {
        if (null === $this->auth) {
            $auth       = new AuthenticationService();
            $auth->setStorage(new Storage($this->getEntityManager()));
            $this->auth = $auth;
        }
        return $this->auth;
    }

    public function getForm() {
        return new LoginForm();
    }

    public function loginAction() {
        $this->checkIdentity();
        $form    = $this->getForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data     = $form->getData();
                $username = $data['login']['username'];
                $password = $data['login']['password'];
                $auth     = $this->getAuth();
                $adapter  = new Adapter($username, $password, $this->getEntityManager());
                $auth->setAdapter($adapter);
                $auth->setStorage(new Storage($this->em));
                $result   = $auth->authenticate($adapter);
                if ($result->isValid()) {
                    return $this->redirect()->toRoute('customer');
                } else {
                    echo "NO";
                }
            }
        }
        return array('form' => $form);
    }

    public function logoutAction() {
        $this->getAuth()->clearIdentity();
    }

}
