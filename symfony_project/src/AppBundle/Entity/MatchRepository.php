<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MatchRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MatchRepository extends EntityRepository {

    public function myFindAll() {
        $sql = 'SELECT p, t FROM AppBundle:Match p JOIN p.terrain t ORDER BY p.date ASC';
        return $this->getEntityManager()->createQuery($sql)->getResult();
    }

    public function getSeasons() {
        $sql = "SELECT DISTINCT p.saison AS id,p.saison AS label FROM `match` AS p";
        $stmt = $this->getEntityManager()->getConnection()->executeQuery($sql);
        return $stmt->fetchAll(\PDO::FETCH_KEY_PAIR);
    }

}
