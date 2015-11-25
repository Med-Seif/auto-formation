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
use Application\Form\LoginForm;

class AuthController extends AbstractActionController {

    protected $em;
    protected $auth;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function _checkIdentity() {
        $auth = $this->getServiceLocator()->get('AppAuthentification');
        if ($auth->hasIdentity()) {
            return $this->redirect()->toRoute('customer');
        }
        return $auth;
    }

    public function getForm() {
        return new LoginForm();
    }

    public function loginAction() {
        //$this->checkIdentity();
        $form    = $this->getForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data     = $form->getData();
                $username = $data['login']['username'];
                $password = $data['login']['password'];
                $auth     = $this->getServiceLocator()->get('AppAuthentification');
                $adapter  = new Adapter($username, $password, $this->getEntityManager());
                $auth->setAdapter($adapter);
                $result   = $auth->authenticate($adapter);
                if ($result->isValid()) {
                    return $this->redirect()->toRoute('customer');
                }
            }
        }

        return array('form' => $form);
    }

    public function logoutAction() {
        $auth = $this->getServiceLocator()->get('AppAuthentification');
        $auth->clearIdentity();
        return $this->redirect()->toRoute('auth');
    }

}
