<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\Event;

class Module {

    private $serviceManager;
    private $eventManager;
    private $sharedEventManager;

    /**
     *
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e) {
        $this->serviceManager     = $e->getApplication()->getServiceManager();
        $this->eventManager       = $e->getApplication()->getEventManager();
        $this->sharedEventManager = $this->eventManager->getSharedManager();
        $this->sharedEventManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', array($this, 'settingUpControllerAccess'), 100);
        $this->eventManager->attachAggregate(new EventManager\AuthEventsListener($this->serviceManager));
    }

    public function settingUpControllerAccess(MvcEvent $e) {
        $auth  = $e->getApplication()->getServiceManager()->get('AppAuthentification');
        //var_dump($auth);die('r');
        $route = $e->getRouteMatch()->getMatchedRouteName();
        if (!$auth->hasIdentity()) {
            if ($route != 'auth') {
                $e->getTarget()->redirect()->toRoute('auth'); // OR => $e->getTarget()->getPluginManager()->get('Redirect')->toRoute('auth');
            }
        } else {
            if ($route == 'auth') {
                $e->getTarget()->redirect()->toRoute('home');
            }
        }
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
