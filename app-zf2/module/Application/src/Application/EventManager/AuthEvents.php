<?php

namespace Application\EventManager;

use Zend\ServiceManager\ServiceManager;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class AuthEvents implements ListenerAggregateInterface {

    protected $listeners = array();

    public function __construct($sm) {
        $this->serviceManager = $sm;
    }

    public function attach(EventManagerInterface $events) {
        $this->listeners[] = $events->getSharedManager()->attach('Auth.events','login', array($this, 'logUserAccess'));
        $this->listeners[] = $events->getSharedManager()->attach('Auth.events','logout', array($this, 'logUserAccess'));
    }

    public function detach(EventManagerInterface $events) {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function logUserAccess(EventInterface $event) {
        $eventName = $event->getName();
        $em        = $this->serviceManager->get('Doctrine\ORM\EntityManager');
        $user      = $event->getParam('user');
        $auth      = new \Application\Entity\Auth();
        $auth->setSessionId(session_id());
        $auth->setUser($em->find('Application\Entity\User', $user->getId()));
        $auth->setOperationTime(new \DateTime());
        if ('login' == $eventName) {
            $auth->setConnected(1);
        } elseif ('logout' == $eventName) {
            $auth->setConnected(0);
        }
        $em->persist($auth);
        $em->flush();
    }

}
