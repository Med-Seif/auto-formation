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

    public function searchCustomers($query) {
        $qb       = $this->createQueryBuilder('c');
        $qb->select();
        if ($query->label) {
            $qb->where($qb->expr()->like('c.label',':label'))->setParameter('label', '%' . $query->label . '%');
        }
        if ($query['address']) {
            $qb->andwhere($qb->expr()->like('c.address',':address'))->setParameter('address', '%' . $query->address . '%');
        }
        if ($query['country']) {
            $qb->andwhere('c.country= :country')->setParameter('country', $query->country);
        }
        if ($query['date']) {
            $qb->andwhere('c.date= :date')->setParameter('date', $query->date);
        }
        $result = $qb->getQuery()->getResult();
        return $result;
    }

}
