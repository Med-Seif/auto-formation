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

class IndexController extends AbstractActionController {

    public function indexAction() {
        return array(
            'data' => array(
                array(
                    'id'    => 1,
                    'label' => 'abc',
                ),
                array(
                    'id'    => 2,
                    'label' => 'def')
            )
        );
    }

    public function mvcAction() {
        $routeMatch = $this->getEvent()->getRouteMatch()->getMatchedRouteName();
        $response   = $this->getResponse();
        $response->setStatusCode(500);
        $this->getEvent()->setResult('Invalid identifier; cannot complete request');
        echo ($this->generator()->generate());
        var_dump($this->getServiceLocator()->get('charts')->get('users')->getData());
        return false;
    }

}
