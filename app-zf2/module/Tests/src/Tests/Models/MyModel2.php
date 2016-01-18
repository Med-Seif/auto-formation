<?php

/**
 * Description of MyModel1
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Tests\Models;

use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class MyModel2 implements EventManagerAwareInterface {

    public $eventManager;
    var $a;
    var $b;
    var $c;
    public function _do2() {
        $res = $this->getEventManager()->trigger(__FUNCTION__, $this, array('params_do1' => array('x','y','z')));
        \Zend\Debug\Debug::dump($res->last());
    }
    public function getEventManager() {
        if (!$this->eventManager) {
            $events = new EventManager();
            $events->attach(new \Tests\Events\MyListener());
            $this->setEventManager($events);
        }
        return $this->eventManager;
    }

    public function setEventManager(EventManagerInterface $eventManager) {

        $eventManager->setIdentifiers(array(
            __CLASS__,
            'm2',
            get_class($this)
        ));
        $this->eventManager = $eventManager;
    }

}
