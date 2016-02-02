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

    public function indexAction() {
        /* @var $cache \Zend\Cache\Storage\Adapter\Filesystem */
        $cache = $this->getServiceLocator()->get('MyCache');
        $res   = $cache->setItem('1', 'Chakala');
        d($res);
        return FALSE;
    }

    public function showcacheAction() {
        /* @var $cache \Zend\Cache\Storage\Adapter\Filesystem */
        $cache = $this->getServiceLocator()->get('MyCache');
        $res   = $cache->getItem('1');
        d($res);
        return FALSE;
    }

}
