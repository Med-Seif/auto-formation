<?php

/**
 * Description of ChartsPluginManager
 *
 * @author Med_Seif <bromdhane@gail.com>
 */

namespace Admin\Plugin;

class ChartsPluginManager extends \Zend\ServiceManager\AbstractPluginManager {

    protected $invokableClasses = array(
        'users'     => 'Admin\Plugin\Chart\Users',
        'customers' => 'Admin\Plugin\Chart\Customers'
    );

    public function validatePlugin($plugin) {

    }

}
