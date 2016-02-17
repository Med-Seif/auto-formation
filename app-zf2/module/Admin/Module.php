<?php

namespace Admin;

use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventInterface as Event;

class Module {

    public $config;

    public function getAutoloaderConfig() {
        /**
         * Configuring classmap autoloader
         * To generate a new file "autoload_classmap.php", run >_D:\www\auto-formation\app-zf2\vendor\bin\classmap_generator.php.bat <dir>"
         * after been moved to the directory to scan
         */
        $loader = new \Zend\Loader\ClassMapAutoloader();
        // Register the class map:
        $loader->registerAutoloadMap(__DIR__ . '/../autoload_classmap.php');
        // Register with spl_autoload:
        $loader->register();
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

    public function getControllerConfig() {

        return array('invokables' => array(
                'Admin\Controller\Index' => Controller\IndexController::class,
                'Admin\Controller\Chart' => Controller\ChartController::class,
                'Admin\Controller\User'  => Controller\UserController::class,
        ));
    }
}
