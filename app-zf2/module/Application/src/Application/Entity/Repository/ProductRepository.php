<?php

/**
 * Description of CustomerRepository
 *
 * @author Seif
 */

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository {

    public function findAll() {
        return $this->findBy(array(), array('id' => 'ASC'));
    }

}
