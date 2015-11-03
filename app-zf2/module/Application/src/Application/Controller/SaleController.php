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
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

class SaleController extends AbstractActionController {

    protected $em;

    public function getForm() {
        $builder  = new \Zend\Form\Annotation\AnnotationBuilder();
        $form     = $builder->createForm('Application\Entity\Sale');
        $form->get('product')->getProxy()->setObjectmanager($this->getEntityManager()); // getProxy() returns an instance of "DoctrineModule\Form\Element\Proxy"
        $form->get('customer')->getProxy()->setObjectmanager($this->getEntityManager());
        $form->add(array(
            'name'       => 'submit',
            'type'       => 'Submit',
            'attributes' => array(
                'value' => 'Save',
                'id'    => 'submit-button',
                'class' => 'btn btn-info',
            ),
        ));
        $hydrator = new AggregateHydrator();
        $hydrator->add(new DoctrineHydrator($this->em, 'Application\Entity\Product'));
        $hydrator->add(new DoctrineHydrator($this->em, 'Application\Entity\Customer'));
        $form->setHydrator($hydrator);
        /*
          $filterDate = $form->getInputFilter()->get('date');
          $myFilter   = new \Zend\Filter\Callback(array(
          'callback' => function($value) {
          return \DateTime::createFromFormat('d/m/Y', $value);
          }
          )
          );
         */
        //$filterDate->getFilterChain()->attach($myFilter);
        return $form;
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction() {
        $sales      = $this->getEntityManager()->getRepository('Application\Entity\Sale')->findAll();
        $collection = new ArrayCollection($sales);
        $paginator  = new Paginator(new Adapter($collection));
        $page       = $this->getRequest()->getQuery()->page;
        $paginator->setCurrentPageNumber($page)->setItemCountPerPage(10);
        return array('sales' => $paginator);
    }

    public function addAction() {
        $form    = $this->getForm();
        $form->get('product')->getProxy()->setObjectmanager($this->getEntityManager()); // getProxy() returns an instance of "DoctrineModule\Form\Element\Proxy"
        $form->get('customer')->getProxy()->setObjectmanager($this->getEntityManager());
        $em      = $this->getEntityManager();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $sale = new \Application\Entity\Sale();
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $sale->setDate(date_create_from_format('d/m/Y', $data['date']));
                $sale->setQuantity($data['quantity']);
                $sale->setCustomer($em->find('Application\Entity\Customer', $data['customer']));
                $sale->setProduct($em->find('Application\Entity\Product', $data['product']));
                $em->persist($sale);
                $em->flush();
                $this->flashMessenger()->addSuccessMessage("Object Sale was successfully inserted");
                return $this->redirect()->toRoute('sale');
            }
        }
        return array('form' => $form);
    }

    /**
     *
     * @return type
     * @throws \Exception
     */
    public function editAction() {
        $em   = $this->getEntityManager();
        $id   = $this->params()->fromRoute('id');
        $sale = $em->find('Application\Entity\Sale', $id);
        if (!$sale) {
            throw new \Exception("$id is not found in the database");
        }
        $form    = $this->getForm();
        $form->populateValues($sale->toArray());
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $sale->setCustomer($em->find('Application\Entity\Customer', $data['customer']));
                $sale->setProduct($em->find('Application\Entity\Product', $data['product']));
                $sale->setQuantity($data['quantity']);
                $sale->setDate(date_create_from_format('d/m/Y', $data['date']));
                $em->persist($sale);
                $em->flush();
                $this->flashMessenger()->addSuccessMessage("Object Sale was successfully edited");
                return $this->redirect()->toRoute('sale');
            }
        }
        return array(
            'form' => $form,
            'id'   => $id);
    }

    public function deleteAction() {
        $em   = $this->getEntityManager();
        $id   = $this->params()->fromRoute('id');
        $sale = $em->find('Application\Entity\Sale', $id);
        if (!$sale) {
            throw new \Exception("$id is not found in the database");
        }
        $this->em->remove($sale);
        $this->em->flush();
        $this->flashMessenger()->addSuccessMessage("Object Sale was successfully removed");
        return $this->redirect()->toRoute('sale');
    }

}
