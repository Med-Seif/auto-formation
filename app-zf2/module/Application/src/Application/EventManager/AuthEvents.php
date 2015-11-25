<?php

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class AuthEvents implements ListenerAggregateInterface {

    protected $listeners = array();

    public function __construct() {

    }

    public function attach(EventManagerInterface $events) {
        $this->listeners[] = $events->attach('do', array($this, 'log'));
        $this->listeners[] = $events->attach('doSomethingElse', array($this, 'log'));
    }

    public function detach(EventCollection $events) {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function log(EventInterface $e) {
        $event  = $e->getName();
        $params = $e->getParams();
        $this->log->info(sprintf('%s: %s', $event, json_encode($params)));
    }

}
