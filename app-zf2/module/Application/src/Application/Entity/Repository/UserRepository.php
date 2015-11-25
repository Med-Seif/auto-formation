<?php

/**
 * Description of CustomerRepository
 *
 * @author Seif
 */

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {

    public function isValid($username, $password) {
        $qb     = $this->createQueryBuilder('u');
        $qb->select();
        $qb->where('u.username= :username')->setParameter('username', $username);
        $qb->andwhere('u.password= :password')->setParameter('password', md5($password));
        $result = $qb->getQuery()->getArrayResult();
        if ($result) {
            return $qb->getQuery()->getSingleResult();
        }
        return false;
    }

    public function getConnected() {
        $query = $this->getEntityManager()->createQuery("SELECT u FROM Application\Entity\User u JOIN u.auths a WHERE a.connected = ?1");
        $query->setParameter(1, 1);
        return $query->getResult();
    }

    public function isConnected($id) {
        $query = $this->getEntityManager()->createQuery("SELECT u FROM Application\Entity\User u JOIN u.auths a WHERE a.connected = ?1 AND a.id_user = ?2");
        $query->setParameter(1, 1);
        $query->setParameter(2, $id);
        return $query->getResult();
    }

}
