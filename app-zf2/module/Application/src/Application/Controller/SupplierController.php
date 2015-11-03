<?php

/**
 * Description of CustomerController
 *
 * @author Seif
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use Doctrine\Common\Collections\ArrayCollection;
use DoctrineModule\Paginator\Adapter\Collection as Adapter;
use Zend\Paginator\Paginator;

class SupplierController extends AbstractActionController {

    protected $em;

    public function getForm() {
        $form = \Application\Form\SupplierForm::getInstance();
        return $form;
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction() {
        $suppliers  = $this->getEntityManager()->getRepository('Application\Entity\Supplier')->findAll();
        $collection = new ArrayCollection($suppliers);
        $paginator  = new Paginator(new Adapter($collection));
        $page       = $this->getRequest()->getQuery()->page;
        $paginator->setCurrentPageNumber($page)->setItemCountPerPage(10);
        return array('suppliers' => $paginator);
    }

    public function addAction() {
        $form     = $this->getForm();
        $request  = $this->getRequest();
        $supplier = new \Application\Entity\Supplier();
        $form->bind($supplier);
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($supplier);
                $this->getEntityManager()->flush();
                $this->flashMessenger()->addSuccessMessage("Object Supplier was successfully inserted");
                return $this->redirect()->toRoute('supplier');
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $form     = $this->getForm();
        $em       = $this->getEntityManager();
        $id       = $this->params()->fromRoute('id');
        $supplier = $em->find('Application\Entity\Supplier', $id);
        if (!$supplier) {
            throw new \Exception("$id is not found in the database");
        }
        $request = $this->getRequest();
        $form->bind($supplier);
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($supplier);
                $this->getEntityManager()->flush();
                $this->flashMessenger()->addSuccessMessage("Object Supplier was successfully edited");
                return $this->redirect()->toRoute('supplier');
            }
        }
        return array(
            'form' => $form,
            'id'   => $id);
    }

    public function deleteAction() {

    }

}
