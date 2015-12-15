<?php

namespace Admin;

use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventInterface as Event;

class Module {

    public $config;

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e) {
        $this->config       = $e->getApplication()->getServiceManager()->get('config');
        $eventManager       = $e->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        $sharedEventManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', array($this, 'setLayout'), 100);
    }

    public function setLayout($e) {
        $controllerClass = get_class($e->getTarget());
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        $e->getTarget()->layout('layout/layout.' . strtolower($moduleNamespace) . '.phtml');
    }

}
