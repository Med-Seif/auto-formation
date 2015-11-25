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

    /**
     *
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e) {
        $this->serviceManager = $e->getApplication()->getServiceManager();
        $eventManager         = $e->getApplication()->getEventManager();
        $sharedEventManager   = $eventManager->getSharedManager();
        $sharedEventManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', array($this, 'settingUpControllerAccess'), 100);
        $sharedEventManager->attach('Auth.events', '*', array($this, 'logUserAccess'));
        /*
          $eventManager->attach('*', function($e) {
          var_dump($e->getName() . " - " . get_class($e->getTarget()));
          });

          $sharedEventManager->attach('*', '*', function($e) {
          var_dump($e->getName() . " - " . get_class($e->getTarget()));
          });
         * */
    }

    public function settingUpControllerAccess(MvcEvent $e) {
        $auth  = $this->serviceManager->get('AppAuthentification');
        $route = $e->getRouteMatch()->getMatchedRouteName();
        /*
          if (!$auth->hasIdentity()) {
          if ($route != 'auth') {
          $e->getTarget()->redirect()->toRoute('auth'); // OR => $e->getTarget()->getPluginManager()->get('Redirect')->toRoute('auth');
          }
          } else {
          if ($route == 'auth') {
          $e->getTarget()->redirect()->toRoute('home');
          }
          } */
    }

    public function logUserAccess(Event $event) {
        $eventName = $event->getName();
        $em        = $this->serviceManager->get('Doctrine\ORM\EntityManager');
        $user      = $event->getParam('user');
        $auth      = new \Application\Entity\Auth();
        $auth->setSessionId(session_id());
        $auth->setUser($em->find('Application\Entity\User', $user->getId()));
        if ('event.login' == $eventName) {
            $auth->setConnected(1);
            $auth->setConnectTime(new \DateTime());
        } elseif ('event.logout' == $eventName) {
            $auth->setConnected(0);
            $auth->setDisconnectTime(new \DateTime());
        }
        $em->persist($auth);
        $em->flush();
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
