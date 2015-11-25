<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

return array(
    'router'          => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /admin/:controller/:action
            'admin' => array(
                'type'          => 'Literal',
                'options'       => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        //'__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults'    => array(
                            ),
                        ),
                    ),
                ),
            ),
            'user'  => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/user[.:action][.:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults'    => array(
                        'controller' => 'Admin\Controller\User',
                        'action'     => 'index',
                    ),
                ),
            ),
            'chart' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/chart[@:action][@:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults'    => array(
                        'controller' => 'Admin\Controller\Chart',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(),
        'factories'          => array(
            'Admin\Model\UserTable' => function($sm) {
                $tableGateway = $sm->get('UserTableGateway');
                $table        = new Model\UserTable($tableGateway);
                return $table;
            },
            'UserTableGateway'  => function ($sm) {
                $dbAdapter          = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new Model\User());
                return new \Zend\Db\TableGateway\TableGateway('users', $dbAdapter, null, $resultSetPrototype);
            },
        ),
        'services'     => array(),
        'invokables'   => array(),
        'aliases'      => array(),
        'initializers' => array()
    ),
    'controllers'  => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Chart' => 'Admin\Controller\ChartController',
            'Admin\Controller\User'  => 'Admin\Controller\UserController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
