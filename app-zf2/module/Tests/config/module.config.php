<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Tests;

return array(
    'router'          => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /admin/:controller/:action
            'tests'    => array(
                'type'          => 'Literal',
                'options'       => array(
                    'route'    => '/tests',
                    'defaults' => array(
                        // '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Tests\Controller\Index',
                        'action'     => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults'    => array()
                        )
                    )
                )
            ),
            'events'   => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/events[.:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults'    => array(
                        'controller' => 'Tests\Controller\Events',
                        'action'     => 'index'
                    )
                )
            ),
            'db'       => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/db[.:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults'    => array(
                        'controller' => 'Tests\Controller\Db',
                        'action'     => 'index'
                    )
                )
            ),
            'perf'     => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/perf[.:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults'    => array(
                        'controller' => 'Tests\Controller\Perf',
                        'action'     => 'index'
                    )
                )
            ),
            'security' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/security[.:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults'    => array(
                        'controller' => 'Tests\Controller\Security',
                        'action'     => 'index'
                    )
                )
            ),
            'fieldset' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/form[.:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults'    => array(
                        'controller' => 'Tests\Controller\Form',
                        'action'     => 'index'
                    )
                )
            )
        )
    ),
    'controllers'     => array(
        'invokables' => array(
            'Tests\Controller\Index'    => 'Tests\Controller\IndexController',
            'Tests\Controller\Events'   => 'Tests\Controller\EventsController',
            'Tests\Controller\Db'       => 'Tests\Controller\DbController',
            'Tests\Controller\View'     => 'Tests\Controller\ViewController',
            'Tests\Controller\Perf'     => 'Tests\Controller\PerfController',
            'Tests\Controller\Security' => 'Tests\Controller\SecurityController',
            'Tests\Controller\Utils'    => 'Tests\Controller\UtilsController',
            'Tests\Controller\Filter'   => 'Tests\Controller\FilterController',
            'Tests\Controller\Form'     => 'Tests\Controller\FormController',
        ),
        'aliases'    => array(
            'tests-index' => 'Tests\Controller\Index',
            'view'        => 'Tests\Controller\View',
            'security'    => 'Tests\Controller\Security',
            'utils'       => 'Tests\Controller\Utils',
            'filter'      => 'Tests\Controller\Filter',
            'form'        => 'Tests\Controller\Form',
        )
    ),
    'service_manager' => array(
        'services'          => array('seif' => "A"),
        'factories'         => array(
            'AppAuthentification' => function($sm) {
                $auth = new \Zend\Authentication\AuthenticationService();
                $auth->setStorage(new \Application\Auth\AppStorage());
                return $auth;
            },
            'MyAppCacheAdapter' => function($sm) {
                // adapterFactoty accepts a class instance while factory() accepts a string
                //$cache = \Zend\Cache\StorageFactory::adapterFactory(new \Tests\Cache\MyAppCacheAdapter($sm->get('Zend\Db\Adapter\Adapter')));
                $cache  = new \Tests\Cache\MyAppCacheAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                $plugin = \Zend\Cache\StorageFactory::pluginFactory('serializer');
                //$plugin = new \Zend\Cache\Storage\Plugin\Serializer(); // works too!
                $cache->addPlugin($plugin);
                return $cache;
            }
        ),
    //'services' => array('seif' => basename(__FILE__))
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
            __DIR__ . '/../view2' // added a new location to search in in order to locate template files
        ),
        'template_map'        => array(
            'tests/index/index' => __DIR__ . '/../view/tests/index/index.phtml',
        ),
    ),
    'view_helpers' => array(
    //'invokables' => array('MyViewHelper' => 'Tests\ViewHelpers\MyViewHelper')
    ),
    //'filters'      => array('invokables' => array('ReverseString' => 'Tests\Filter\ReverseString')),
    'zfctwig'      => array(
        'extensions'          => array(
            'Twig_Extension_Debug'
        ), // to enble the dump function
        'environment_options' => array(
            'debug'            => true,
            'strict_variables' => true
        )
    ) // see http://twig.sensiolabs.org/doc/api.html for all options

        /*
          'zfctwig'      => array(
          'environment_loader'        => 'ZfcTwigLoaderChain',
          'environment_class'         => 'Twig_Environment',
          'environment_options'       => array(),
          'loader_chain'              => array('ZfcTwigLoaderTemplateMap','ZfcTwigLoaderTemplatePathStack'),
          'extensions'                => array('zfctwig' => 'ZfcTwigExtension'),
          'suffix'                    => 'twig',
          'enable_fallback_functions' => true,
          'disable_zf_model'          => true,
          'helper_manager'            => array('configs' => array('Zend\Navigation\View\HelperConfig')
          )
          ),
         */
);
