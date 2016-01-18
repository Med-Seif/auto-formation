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

class MyModel1 implements EventManagerAwareInterface {

    public $eventManager;
    var $x;
    var $y;
    var $z;

    public function _do1() {
        $res = $this->getEventManager()->trigger(__FUNCTION__, $this, array('params_do1' => array('a', 'b', 'c')));
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
            'm1',
            get_class($this)
        ));
        $this->eventManager = $eventManager;
    }

}
