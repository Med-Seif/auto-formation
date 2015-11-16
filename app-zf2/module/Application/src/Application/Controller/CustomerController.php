<?php

/**
 * Description of CustomerController
 *
 * @author Seif
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
//use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Doctrine\Common\Collections\ArrayCollection;
use DoctrineModule\Paginator\Adapter\Collection as Adapter;
use Zend\Paginator\Paginator;
use Application\Auth\Storage;
use Zend\Mvc\MvcEvent;

class CustomerController extends AbstractActionController {

    protected $em;

    CONST FORM_CUSTOMER_CU     = 1; // add/update
    CONST FORM_CUSTOMER_SEARCH = 2; // search
    public function onDispatch(MvcEvent $e) {
        parent::onDispatch($e);
    }
    /**
     *
     * @return Zend\Form\Form
     */
    public function getForm($flag = self::FORM_CUSTOMER_CU) {
        switch ($flag) {
            case self::FORM_CUSTOMER_CU:
                $form = $this->getServiceLocator()->get('CustomerForm');
                break;
            case self::FORM_CUSTOMER_SEARCH:
                $form = new \Application\Form\SearchCustomerForm($this->getEntityManager());
                break;
        }
        return $form;
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function checkIdentity() {
        $auth = $this->getServiceLocator()->get('AppAuthentification');
        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('auth');
        }
        return $auth;
    }

    public function indexAction() {
        $this->checkIdentity();
        $form = $this->getForm(self::FORM_CUSTOMER_SEARCH);
        return array(
            'form'             => $form,
            'customerFieldset' => $form->get('customer'));
    }

    public function ajaxPagesAction() {
        $request = $this->getRequest();
        //$form    = $this->getForm(self::FORM_CUSTOMER_SEARCH);
        if (!$request->isXmlHttpRequest()) {
            throw new Exception("USER : Only ajax Requests");
        }
        if ($request->isGet()) {
            $data = $request->getQuery();
        }
        $customers  = $this->getEntityManager()->getRepository('Application\Entity\Customer')->searchCustomers($data);
        $collection = new ArrayCollection($customers);
        $paginator  = new Paginator(new Adapter($collection));
        $page       = $this->getRequest()->getQuery()->page;
        $paginator->setCurrentPageNumber($page)->setItemCountPerPage(10);
        $res        = array();
        foreach ($paginator as $customerItem) {
            $res [] = $customerItem->getValues();
        }
        $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                    'count'     => count($collection),
                    'customers' => $res,
                    'pages'     => $paginator->getPages()
                        )
                )
        );
        return $this->response;
    }

    public function addAction() {

        $em       = $this->getEntityManager();
        $form     = $this->getForm();
        $request  = $this->getRequest();
        $customer = new \Application\Entity\Customer();
        if ($request->isPost()) {
            $inputFilter = \Application\InputFilter\CustomerInputFilter::getInstance($this->getEntityManager());
            $form->setInputFilter($inputFilter);
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $customer->setLabel($data['label']);
                $customer->setAddress($data['address']);
                $customer->setCountry($em->find('Application\Entity\Country', $data['country']));
                $customer->setDate(date_create_from_format('d/m/Y', $data['date']));
                $em->persist($customer);
                $em->flush();
                $this->flashMessenger()->addSuccessMessage($form->getData()['label'] . " was successfully inserted to database");
                // Redirection
                return $this->redirect()->toRoute('customer');
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        //if ($this->getRequest()->isXmlHttpRequest()){} Test if (ajax request)
        $em       = $this->getEntityManager();
        $form     = $this->getForm();
        $id       = $this->params()->fromRoute('id');
        $customer = $em->find('Application\Entity\Customer', $id);
        if (!$customer) {
            throw new \Exception("$id is not found in the database");
        }
        $form->populateValues($customer->toArray());
        $request = $this->getRequest();
        if ($request->isPost()) {
            $inputFilter = \Application\InputFilter\CustomerInputFilter::getInstance($em, $customer);
            $form->setInputFilter($inputFilter);
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $customer->setLabel($data['label']);
                $customer->setAddress($data['address']);
                $customer->setDate(date_create_from_format('d/m/Y', $data['date']));
                $customer->setCountry($em->find('Application\Entity\Country', $data['country']));
                $em->persist($customer);
                $em->flush(); // $customer is updated with validated form values because we previously called $form->bind($customer)
                $this->flashMessenger()->addSuccessMessage($data['label'] . " was successfully edited");
                return $this->redirect()->toRoute('home');
            }
        }
        return array(
            'form' => $form,
            'id'   => $id);
    }

    public function deleteAction() {
        $em       = $this->getEntityManager();
        $id       = $this->params()->fromRoute('id');
        $customer = $em->find('Application\Entity\Customer', $id);
        if (!$customer) {
            throw new \Exception("$id is not found in the database");
        }
        $this->em->remove($customer);
        $this->em->flush();
        $this->flashMessenger()->addSuccessMessage($customer->getLabel() . " was successfully removed");
        /** To disable layout
          $view = new \Zend\View\Model\ViewModel();
          $view = new ViewModel();
          $view->setTerminal(true);
          return $view;
         */
        /** Disable layout+view
          return $this->response;
         */
        /** Disable View
          return false;
         */
        return $this->redirect()->toRoute('home');
    }

    public function salesAction() {
        $em       = $this->getEntityManager();
        $id       = $this->params()->fromRoute('id');
        $customer = $em->find('Application\Entity\Customer', $id);
        if (!$customer) {
            throw new \Exception("$id is not found in the database");
        }
        $sales = $customer->getSales();
        return array(
            'customer' => $customer,
            'id'       => $id,
            'sales'    => $sales
        );
    }

}
