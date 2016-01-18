<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Tests\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\EventManager\SharedEventManager;
use Tests\Models\MyModel1;
use Tests\Models\MyModel2;
use Zend\View\Model\ViewModel;
use Zend\Debug\Debug;
use Zend\EventManager\EventManager;

class EventsController extends AbstractActionController {

    public function indexAction() {

    }

    public function example0Action() {
        $res[]  = "Basic example";
        $events = new EventManager();
        $events->attach('do', function ($e) {
            $event  = $e->getName();
            $params = $e->getParams();
            printf(
                    'Handled event "%s", with parameters %s', $event, json_encode($params)
            );
        });

        $params = array('foo' => 'bar', 'baz' => 'bat');
        $events->trigger('do', null, $params);
        $view   = new ViewModel(array('output' => implode("<br />", $res)));
        $view->setTemplate('tests/index/index');
        return $view;
    }

    public function example1Action() {
        $res[]        = "Triggering a function inside a class implementing EventManagerAwareInterface with the SharedEventManager";
        $sharedEvents = new SharedEventManager();
        $sharedEvents->attach('Tests\Models\MyModel1', '_do', function ($e) {
            $event  = $e->getName();
            $target = get_class($e->getTarget());
            $params = $e->getParams();
            Debug::dump($event, 'event');
            Debug::dump($target, 'target');
            Debug::dump($params, 'params');
        });
        $m1     = new MyModel1();
        $m1->getEventManager()->setSharedManager($sharedEvents);
        $res [] = $m1->_do('bar');
        $view   = new ViewModel(array(
            'output' => implode("<br />", $res),
        ));
        $view->setTemplate('tests/index/index');
        return $view;
    }

    public function example2Action() {
        $m1    = new MyModel1();
        $res[] = "Triggering a function inside a class implementing EventManagerAwareInterface with the EventManager";
        $m1->getEventManager()->attach('_do', function ($e) {
            $event  = $e->getName();
            $target = get_class($e->getTarget());
            $params = $e->getParams();
            Debug::dump($event, 'event');
            Debug::dump($target, 'target');
            Debug::dump($params, 'params');
        });
        $res [] = $m1->_do('bar');
        $view   = new ViewModel(array(
            'output' => implode("<br />", $res),
        ));
        $view->setTemplate('tests/index/index');
        return $view;
    }

    public function example3Action() {
        $m1    = new MyModel1();
        $m2    = new MyModel2();
        $res[] = "Using listeners";
        $res[] = $m1->_do1();
        $res[] = $m2->_do2();
        return false;
    }

}
