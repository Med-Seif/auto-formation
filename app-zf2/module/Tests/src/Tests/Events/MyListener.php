<?php

/**
 * Description of MyListener
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Tests\Events;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class MyListener implements ListenerAggregateInterface {

    protected $listeners = array();

    public function attach(EventManagerInterface $events) {
        $this->listeners[] = $events->attach('_do1', array($this, 'go'));
        $this->listeners[] = $events->attach('_do2', array($this, 'go'));
        //$this->listeners[] = $events->getSharedManager()->attach('m1', '_do1', array($this, 'go'));
        //$this->listeners[] = $events->getSharedManager()->attach('m2', '_do2', array($this, 'go'));
    }

    public function detach(EventManagerInterface $events) {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function go(EventInterface $e) {
        return ['name' => $e->getName(), 'params' => $e->getParams(), 'class' => get_class($e->getTarget()), 'Triggered from ' =>  __CLASS__];
    }

}
