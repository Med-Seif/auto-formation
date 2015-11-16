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

class Adapter implements AdapterInterface {

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
        $user   = $this->em->getRepository('Application\Entity\User')->isValid($this->username, $this->password);
        if ($user) {
            $code = Result::SUCCESS;
            return new Result($code, $user);
        } else {
            $code = Result::FAILURE;
            return new Result($code, '');
        }
    }

}
