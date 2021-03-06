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
        \Zend\Filter\StaticFilter::getPluginManager()->setInvokableClass('ReverseString', 'Tests\Filter\ReverseString');
    }

    public function getConfig() {
        //echo "<pre>". basename(__FILE__ . '::' . __FUNCTION__) . "</pre>";
        $this->arr[] = __FUNCTION__;
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * service_manager
     */
    public function getServiceConfig() {
        //echo "<pre>". basename(__FILE__ . '::' . __FUNCTION__) . "</pre>";
        return array('services' => array('seif' => "B"));
    }

    public function onBootstrap(\Zend\Mvc\MvcEvent $e) {

        $this->arr[] = __FUNCTION__;
        /**
         * Configuring session
         */
        $config      = new \Zend\Session\Config\SessionConfig();
        $config->setOptions(array('remember_me_seconds' => 14400));
        $manager     = new \Zend\Session\SessionManager($config);
        \Zend\Session\Container::setDefaultManager($manager);
        $tg          = new \Zend\Db\TableGateway\TableGateway('_session', $e->getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter'));
        $saveHandler = new \Zend\Session\SaveHandler\DbTableGateway($tg, new \Zend\Session\SaveHandler\DbTableGatewayOptions());
        $manager->setSaveHandler($saveHandler);
        $manager->getValidatorChain()->attach('session.validate', array(new \Zend\Session\Validator\RemoteAddr(), 'isValid'));
        $manager->getValidatorChain()->attach('session.validate', array(new \Zend\Session\Validator\HttpUserAgent(), 'isValid'));
        /* @var $fpm \Zend\Filter\FilterPluginManager */
        $fpm = $e->getApplication()->getServiceManager()->get('filtermanager');
        //$fpm->setInvokableClass('ReverseString', 'Tests\Filter\ReverseString');
        //$container   = new \Zend\Session\Container('last_url');
        //$container->url = "";
    }

    function getFilterConfig() {
        return array(
            'invokables' => array(
                'ReverseString' => 'Tests\Filter\ReverseString'));
    }
}
