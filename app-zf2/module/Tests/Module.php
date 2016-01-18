<?php

namespace Tests;

class Module {

    public function getAutoloaderConfig() {
        var_dump(__FUNCTION__);
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function init() {
        var_dump(__FUNCTION__);
    }

    public function getConfig() {
        var_dump(__FUNCTION__);
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * service_manager
     */

    public function getServiceConfig() {
        var_dump(__FUNCTION__);
    }
    /**
     * controllers
     * @return type
     */
    public function getControllerConfig() {
    }

    public function getControllerPluginConfig() {
        var_dump(__FUNCTION__);
    }

    /**
     * view_helpers
     */
    public function getViewHelperConfig() {
        var_dump(__FUNCTION__);
    }

    public function onBootstrap(\Zend\Mvc\MvcEvent $e) {
        var_dump(__FUNCTION__);
        $application = $e->getApplication()->getServiceManager();
        /* @var $renderer \Zend\View\Renderer\PhpRenderer */
        $renderer    = $application->get('\Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle("YES");
    }

}
