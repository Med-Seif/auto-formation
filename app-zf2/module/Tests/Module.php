<?php

namespace Tests;

class Module {
    protected $arr;
    public function getAutoloaderConfig() {
        $this->arr[] = __FUNCTION__;
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function init() {
        $this->arr[] = __FUNCTION__;
    }

    public function getConfig() {
        $this->arr[] = __FUNCTION__;
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * service_manager
     */

    public function getServiceConfig() {
        $this->arr[] = __FUNCTION__;
    }
    /**
     * controllers
     * @return type
     */
    public function getControllerConfig() {
        $this->arr[] = __FUNCTION__;
    }

    public function getControllerPluginConfig() {
        $this->arr[] = __FUNCTION__;
    }

    /**
     * view_helpers
     */
    public function getViewHelperConfig() {
        $this->arr[] = __FUNCTION__;
    }

    public function onBootstrap(\Zend\Mvc\MvcEvent $e) {
        $this->arr[] = __FUNCTION__;
        $sm = $e->getApplication()->getServiceManager();
        /* @var $renderer \Zend\View\Renderer\PhpRenderer */
        $renderer    = $sm->get('\Zend\View\Renderer\PhpRenderer');
        echo "<div class='alert alert-warning' role='alert'><b>" . implode("()</b> => <b>", $this->arr)."()</b>"."</div>";

    }

}
