<?php

/**
 * Description of PerfController
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Tests\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\ViewEvent;

function d() {
    var_dump(func_get_arg(0));
}

class PerfController extends AbstractActionController {

    /**
     * Testing the filesystem cache adapter
     *
     * @return boolean
     */
    public function indexAction() {
        /* @var $cache \Zend\Cache\Storage\Adapter\Filesystem */
        $cache = $this->getServiceLocator()->get('Cache');
        $cache->setItem('Text', "Bakala");
        $o     = new \stdClass();
        $o->a  = 10;
        $o->b  = 20;
        $cache->addItem(rand(1, 10000), $o); // in order to work we must add 'serializer plugin' to handle complex type insertion, see cache.global.php
        return FALSE;
    }
    /**
     * Testing lecture of a cache entry
     *
     * @return boolean
     */
    public function showcacheAction() {
        /* @var $cache \Zend\Cache\Storage\Adapter\Filesystem */
        $cache = $this->getServiceLocator()->get('Cache');
        $res   = $cache->getItem('a_32');
        d($res);
        return FALSE;
    }

    /**
     * Testing cache adapter creation manually 1
     */
    public function test1Action() {
        $cache   = \Zend\Cache\StorageFactory::factory(array('plugins' => array(
                        'exception_handler' => array(
                            'throw_exceptions' => true,
                        ),
                    ),
                    'adapter' => 'filesystem',
                    'ttl'     => 86400,
                    'options' => array(
                        'cache_dir' => __DIR__ . '/../../../../../data/cache/')));
        $cache2  = $this->getServiceLocator()->get('Cache');
        var_dump($cache === $cache2); // returns false;
        var_dump(get_class($cache), get_class($cache2)); // they are the same , one is created with adapterFactory() Metheod and the other is with factory() method
        return new ViewModel();
    }

    /**
     * Testing cache adapter creation manually 2
     */
    public function test2Action() {
        $cache = \Zend\Cache\StorageFactory::factory(array('plugins' => array(
                        'exception_handler' => array(
                            'throw_exceptions' => true,
                        ),
                    ),
                    'adapter' => 'filesystem',
                    'ttl'     => 86400,
                    'options' => array(
                        'cache_dir' => __DIR__ . '/../../../../../data/cache/')));
        d($cache);
        return FALSE;
    }

    /**
     * Creating and testing MyAppCache
     */
    public function test3Action() {
        /* @var $cache \Tests\Cache\MyAppCacheAdapter */
        $cache = $this->getServiceLocator()->get('MyAppCacheAdapter');
        $cache->addItem(rand(1, 10000), "a_" . rand(1, 100));
        $o     = new \stdClass();
        $o->a  = 10;
        $o->b  = 20;
        $cache->addItem(rand(1, 10000), $o); // the item is added aften been serialized (see creation of the adapter in module config file)
        var_dump($cache->getItem("9941")); // not implemented yet
        return false;
    }

    /**
     * Creating and testing MyAppCache
     */
    public function test4Action() {
        /* @var $cache \Tests\Cache\MyAppCacheAdapter */
        $cache  = $this->getServiceLocator()->get('MyAppCacheAdapter');
        $cache2 = $this->getServiceLocator()->get('MyAppCacheAdapter');
        d($cache === $cache2); // returns true
        $cmal = new \Zend\Loader\ClassMapAutoloader();
        return false;
    }

}
