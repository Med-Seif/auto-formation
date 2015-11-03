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
        $builder = new \Zend\Form\Annotation\AnnotationBuilder();
        $form    = $builder->createForm('Application\Entity\Supplier');
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
        return array('products' => $paginator);
    }

    public function addAction() {
        $form = $this->getForm();
        return array('form' => $form);
    }

    public function editAction() {

    }

    public function deleteAction() {

    }

}
