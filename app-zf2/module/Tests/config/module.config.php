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
    'router'       => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /admin/:controller/:action
            'tests'  => array(
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
            'events' => array(
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
            'db'     => array(
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
            )
        )
    ),
    'controllers'  => array(
        'invokables' => array(
            'Tests\Controller\Index'  => 'Tests\Controller\IndexController',
            'Tests\Controller\Events' => 'Tests\Controller\EventsController',
            'Tests\Controller\Db'     => 'Tests\Controller\DbController',
            'Tests\Controller\View'   => 'Tests\Controller\ViewController',
            'Tests\Controller\Perf'   => 'Tests\Controller\PerfController'
        ),
        'aliases'    => array(
            'tests-index' => 'Tests\Controller\Index',
            'view'        => 'Tests\Controller\View'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
            __DIR__ . '/../view2'
        )
    ),
    'view_helpers' => array(
    //'invokables' => array('MyViewHelper' => 'Tests\ViewHelpers\MyViewHelper')
    ),
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
