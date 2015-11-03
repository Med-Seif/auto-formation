<?php

/**
 * Description of CustomerRepository
 *
 * @author Seif
 */

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CustomerRepository extends EntityRepository {

    public function findAll() {
        return $this->findBy(array(), array('label' => 'ASC'));
    }

    public function searchCustomers($data) {
        $customer = $data->customer;
        $qb       = $this->createQueryBuilder('c');
        $qb->select();
        if ($customer['label']) {
            $qb->where($qb->expr()->like('c.label',':label'))->setParameter('label', '%' . $customer['label'] . '%');
        }
        if ($customer['address']) {
            $qb->andwhere($qb->expr()->like('c.address',':address'))->setParameter('address', '%' . $customer['address'] . '%');
        }
        if ($customer['country']) {
            $qb->andwhere('c.country= :country')->setParameter('country', $customer['country']);
        }
        if ($customer['date']) {
            $qb->andwhere('c.date= :date')->setParameter('date', $customer['date']);
        }
        $result = $qb->getQuery()->getResult();
        return $result;
    }

}
