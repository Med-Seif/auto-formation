<?php

/**
 * Description of AppAuthStorage
 *
 * @author Med_Seif <bromdhane@gmail.com>
 */

namespace Application\Auth;

use Zend\Authentication\Storage\StorageInterface;
use Application\Entity\Auth;
use Zend\Session\Container as SessionContainer;

class DbStorage implements StorageInterface {

    private $id;
    private $em;
    private $namespace = "myappauth";
    private $session;

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->session = new SessionContainer($this->namespace);
        $this->id      = session_id();
        $this->em      = $em;
    }

    /**
     * Returns true if and only if storage is empty
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface
     *               If it is impossible to
     *               determine whether storage is empty
     * @return boolean
     */
    public function isEmpty() {
        $auth = $this->em->find('Application\Entity\Auth', $this->id);
        if ($auth) {
            return !$auth->getConnected();
        }
        return true;
    }

    /**
     * Returns the contents of storage
     *
     * Behavior is undefined when storage is empty.
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface
     *               If reading contents from storage is impossible
     * @return mixed
     */
    public function read() {
        return $this->em->find('Application\Entity\Auth', $this->id);
    }

    /**
     * Writes $contents to storage
     *
     * @param  mixed $contents
     * @throws \Zend\Authentication\Exception\ExceptionInterface
     *               If writing $contents to storage is impossible
     * @return void
     */
    public function write($contents) {
        $auth = new Auth();
        $auth->setId($this->id);
        $auth->setUser($this->em->find('Application\Entity\User',$contents->getId()));
        $auth->setConnected(1);
        $auth->setConnectTime(new \DateTime());
        $this->em->persist($auth);
        $this->em->flush();
    }

    /**
     * Clears contents from storage
     *
     * @throws \Zend\Authentication\Exception\ExceptionInterface
     *               If clearing contents from storage is impossible
     * @return void
     */
    public function clear() {
        $auth = $this->em->find('Application\Entity\Auth', $this->id);
        if (!$auth) {
            return false;
        }
        $auth->setConnected(0);
        $auth->setDisconnectTime(new \DateTime());
        $this->em->persist($auth);
        $this->em->flush();
        unset($this->session);
        session_regenerate_id();
    }

    /**
     * Generating random 8 caracters length string
     *
     * @return string
     */
    private static function generateKey() {
        $chaine = "aAbBcCdDeEfFgGHhiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ123456789";
        srand((double) microtime() * 1000000);
        for ($i = 0; $i < 16; $i ++) {
            $key .= $chaine [rand() % strlen($chaine)];
        }
        return $key;
    }

    public function getId() {
        return $this->id;
    }

}
