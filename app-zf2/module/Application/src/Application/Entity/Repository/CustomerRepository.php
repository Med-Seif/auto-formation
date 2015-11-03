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

}
