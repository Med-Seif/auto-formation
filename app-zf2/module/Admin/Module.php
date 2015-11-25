<?php

namespace Admin;

use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module {

    public $config;

    public function init(ModuleManager $moduleManager) {
        /*
        $events = $moduleManager->getEventManager();
        $sharedEventManager = $events->getSharedManager();
        // Registering a listener at default priority, 1, which will trigger
        // after the ConfigListener merges config.
        $sharedEventManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', array($this, 'setLayout'), 100);
        $events->attach(ModuleEvent::EVENT_MERGE_CONFIG, array($this, 'onMergeConfig'));
         *
         */
    }
    /**
     * Happens befor the onBoostrap
     * @param ModuleEvent $e
     */
    public function onMergeConfig(ModuleEvent $e) {
        /*
        var_dump($e->getTarget()->getLoadedModules());
        $configListener                                          = $e->getConfigListener();
        $config                                                  = $configListener->getMergedConfig(false);
        // Modify the configuration; here, we'll remove a specific key:
        $config['view_manager']['template_map']['layout/layout'] = 'D:\www\auto-formation\app-zf2\module\Application\view\layout\layout.admin.phtml';
        // Pass the changed configuration back to the listener:
        $configListener->setMergedConfig($config);
         *
         */
    }

    public function onBootstrap(MvcEvent $e) {
        $this->config       = $e->getApplication()->getServiceManager()->get('config');
        $eventManager       = $e->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        $sharedEventManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', array($this, 'setLayout'), 100);
        //var_dump($this->config);
    }

    public function setLayout($e) {
        $controllerClass = get_class($e->getTarget());
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        $e->getTarget()->layout('layout/layout.' . strtolower($moduleNamespace) . '.phtml');
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}
