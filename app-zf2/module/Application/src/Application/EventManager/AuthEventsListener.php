<?php

namespace Application\EventManager;

use Zend\ServiceManager\ServiceManager;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class AuthEventsListener implements ListenerAggregateInterface {

    protected $listeners = array();

    public function __construct($sm) {
        $this->serviceManager = $sm;
    }

    public function attach(EventManagerInterface $events) {
        $this->listeners[] = $events->getSharedManager()->attach('Auth.events', 'login', array($this, 'logUserLogIn'));
        $this->listeners[] = $events->getSharedManager()->attach('Auth.events', 'login', array($this, 'logUserJsonFile'));
        $this->listeners[] = $events->getSharedManager()->attach('Auth.events', 'logout', array($this, 'logUserLogOut'));
        $this->listeners[] = $events->getSharedManager()->attach('Auth.events', 'logout', array($this, 'logUserJsonFile'));
        $this->listeners[] = $events->getSharedManager()->attach('Auth.events', 'failure', array($this, 'logFailedAttempt'));
    }

    public function detach(EventManagerInterface $events) {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function logUserLogIn(EventInterface $event) {

        $em      = $this->serviceManager->get('Doctrine\ORM\EntityManager');
        $user    = $event->getParam('user');
        $authRow = $em->find('Application\Entity\Auth', $user->getId());
        if ($authRow) {
            $authRow->setConnected(1);
            $authRow->setOperationTime(new \DateTime());
            $authRow->setCount(True);
            $em->persist($authRow);
            $em->flush();
        } else {
            // first connection => No log to JSON
            $event->stopPropagation();
            $auth = new \Application\Entity\Auth();
            $auth->setUser($em->find('Application\Entity\User', $user->getId()));
            $auth->setOperationTime(new \DateTime());
            $auth->setCount(True);
            $auth->setConnected(1);
            $em->persist($auth);
            $em->flush();
        }
    }

    public function logUserJsonFile(EventInterface $event) {
        $content = file_get_contents('logs/logins.json');
        if (!$content) {
            $content = "[]";
        }
        $data          = json_decode($content);
        $user          = $event->getParam('user')->getArrayCopy();
        unset($user['auths'], $user['password']);
        $user ['time'] = date("d-m-Y H:i:s");
        if ($event->getName() == 'login') {
            $user ['connected'] = 1;
        } elseif ($event->getName() == 'logout') {
            $user ['connected'] = 0;
        }
        array_push($data, $user);
        file_put_contents('logs/logins.json', json_encode($data));
    }

    public function logUserLogOut(EventInterface $event) {
        $em      = $this->serviceManager->get('Doctrine\ORM\EntityManager');
        $user    = $event->getParam('user');
        $authRow = $em->find('Application\Entity\Auth', $user->getId());
        if (!$authRow) {
            return false;
        }
        $authRow->setOperationTime(new \DateTime());
        $authRow->setConnected(0);
        $em->persist($authRow);
        $em->flush();
    }

    public function logFailedAttempt(EventInterface $event) {
        $content = file_get_contents('logs/failed-attempts.json');
        if (!$content) {
            $content = "[]";
        }
        $data = json_decode($content);
        array_push($data, $event->getParams());
        file_put_contents('logs/failed-attempts.json', json_encode($data));
    }

}
