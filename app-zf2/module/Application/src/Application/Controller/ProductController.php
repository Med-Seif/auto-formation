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
use Application\Entity\Product;

class ProductController extends AbstractActionController {

    protected $em;

    public function getForm() {
        $form = $this->getServiceLocator()->get('ProductForm');
        $form->get('product')->get('supplier')->getProxy()->setObjectmanager($this->getEntityManager());
        return $form;
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction() {
        $products   = $this->getEntityManager()->getRepository('Application\Entity\Product')->findAll();
        $collection = new ArrayCollection($products);
        $paginator  = new Paginator(new Adapter($collection));
        $page       = $this->getRequest()->getQuery()->page;
        $paginator->setCurrentPageNumber($page)->setItemCountPerPage(10);
        return array('products' => $paginator);
    }

    public function addAction() {
        $form    = $this->getForm();
        $product = new Product();
        $form->bind($product);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($product);
                $this->getEntityManager()->flush();
                $this->flashMessenger()->addSuccessMessage("Object Product was successfully inserted");
                return $this->redirect()->toRoute('product');
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $form    = $this->getForm();
        $em      = $this->getEntityManager();
        $id      = $this->params()->fromRoute('id');
        $product = $em->find('Application\Entity\Product', $id);
        if (!$product) {
            throw new \Exception("$id is not found in the database");
        }
        $form->bind($product);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($product);
                $this->getEntityManager()->flush();
                $this->flashMessenger()->addSuccessMessage("Object Product was successfully edited");
                return $this->redirect()->toRoute('product');
            }
        }
        return array(
            'form' => $form,
            'id'   => $id);
    }

    public function deleteAction() {

    }

}
