<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Stats\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\EventManager\EventManager;

class IndexController extends AbstractActionController {

    public function indexAction() {
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
        return new ViewModel();
    }

}
