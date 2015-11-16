<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Stats;

return array(
    'router'          => array(
        'routes' => array(
            /* 'home'        => array(
              'type'    => 'Zend\Mvc\Router\Http\Literal',
              'options' => array(
              'route'    => '/',
              'defaults' => array(
              'controller' => 'Stats\Controller\Index',
              'action'     => 'index',
              ),
              ),
              ), */
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'stats' => array(
                'type'          => 'Literal',
                'options'       => array(
                    'route'    => '/stats',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Stats\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
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
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories'          => array(
            'translator'   => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
        'services'        => array(),
        'invokables'      => array()
    ),
    'translator'         => array(
        'locale'                    => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers'        => array(
        'invokables' => array(
            'Stats\Controller\Index' => Controller\IndexController::class,
        ),
    ),
    'view_manager'       => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => array(
            'layout/layout'     => __DIR__ . '/../../Application/view/layout/layout.phtml',
            'stats/index/index' => __DIR__ . '/../view/stats/index/index.phtml',
            'error/404'         => __DIR__ . '/../../Application/view/error/404.phtml',
            'error/index'       => __DIR__ . '/../../Application/view/error/index.phtml',
        ),
        'template_path_stack'      => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helper_config' => array(
        'flashmessenger' => array(
            'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
            'message_close_string'     => '</li></ul></div>',
            'message_separator_string' => '</li><li>'
        )
    ),
    // Placeholder for console routes
    'console'            => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'doctrine'           => array(
        'driver' => array(
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../../Application/src/Application/Entity')
            ),
            'orm_default'          => array(
                'drivers' => array(
                    'Stats\Entity' => 'application_entities'
                )
            )))
);
