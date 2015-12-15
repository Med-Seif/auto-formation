<?php

/**
 * Description of AppAdapter
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\Result;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class Adapter implements AdapterInterface,EventManagerAwareInterface {

    protected $eventManager;
    private $username;
    private $password;

    /**
     * Sets username and password for authentication
     *
     * @return void
     */
    public function __construct($username, $password, EntityManager $em) {
        $this->username = $username;
        $this->password = $password;
        $this->em       = $em;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate() {
        $user = $this->em->getRepository('Application\Entity\User')->isValid($this->username, $this->password);
        if ($user) {
            $code = Result::SUCCESS;
            $result = new Result($code, $user);
            return $result;
        } else {
            $code = Result::FAILURE;
            // log all failed attemptions to login
            $this->getEventManager()->trigger("failure", $this, array('username' => $this->username, 'password' => $this->password, 'ip' => $_SERVER['REMOTE_ADDR']));
            return new Result($code, '');
        }
    }

    public function getEventManager() {
        if (!$this->eventManager) {
            $this->setEventManager(new EventManager());
        }
        return $this->eventManager;
    }

    public function setEventManager(EventManagerInterface $eventManager) {
        $eventManager->setIdentifiers(array(
            "Auth.events",
            get_class($this)
        ));
        $this->eventManager = $eventManager;
    }

}
