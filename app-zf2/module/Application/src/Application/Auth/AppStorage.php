<?php

/**
 * Description of AppStorage
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Application\Auth;

use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class AppStorage extends SessionStorage implements EventManagerAwareInterface {

    protected $eventManager;

    /**
     *
     */
    public function clear() {
        $this->getEventManager()->trigger("logout", $this, array('user' => parent::read()));
        parent::clear();
    }

    public function write($contents) {
        $this->getEventManager()->trigger("login", $this, array('user' => $contents));
        parent::write($contents);
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
