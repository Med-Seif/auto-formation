<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'router'          => array(
        'routes' => array(
            'home'        => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'          => 'Literal',
                'options'       => array(
                    'route'    => '/application',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
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
            'customer'    => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/customer[.:action][.:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults'    => array(
                        'controller' => 'Application\Controller\Customer',
                        'action'     => 'index',
                    ),
                ),
            ),
            'product'     => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/product[@:action][@:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults'    => array(
                        'controller' => 'Application\Controller\Product',
                        'action'     => 'index',
                    ),
                ),
            ),
            'supplier'    => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/supplier[@:action][@:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults'    => array(
                        'controller' => 'Application\Controller\Supplier',
                        'action'     => 'index',
                    ),
                ),
            ),
            'sale'        => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/sale[@:action][@:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults'    => array(
                        'controller' => 'Application\Controller\Sale',
                        'action'     => 'index',
                    ),
                ),
            ),
            'auth'        => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/auth[@:action][@:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults'    => array(
                        'controller' => 'Application\Controller\Auth',
                        'action'     => 'login',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
            'Application\Service\AbstractFactory\AppFormAbstractFactory' // injecting the entity manager in their constructors
        ),
        'factories'          => array(
            'translator'          => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'CustomerForm'       => 'Application\Service\Factory\CustomerFormFactory',
        ),
        'services'        => array(),
        'invokables'      => array(
            'UserService' => 'Admin\Service\UserService',
        //'AppAuthentification' => 'Zend\Authentication\AuthenticationService'
        ),
        'aliases'         => array(
            'Zend\Authentication\AuthenticationService' => 'AppAuthentification',
        ),
        'initializers'    => array(
            'Application\Service\Initializer\ObjectManagerInjectorInitializer'
        )
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
            'Application\Controller\Index'    => Controller\IndexController::class,
            'Application\Controller\Customer' => Controller\CustomerController::class,
            'Application\Controller\Product'  => Controller\ProductController::class,
            'Application\Controller\Supplier' => Controller\SupplierController::class,
            'Application\Controller\Sale'     => Controller\SaleController::class,
            'Application\Controller\Auth'     => Controller\AuthController::class,
        ),
        'aliases'    => array(
            'customer' => 'Application\Controller\Customer'
        )
    ),
    'view_manager'       => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
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
                'paths' => array(__DIR__ . '/../src/Application/Entity')
            ),
            'orm_default'          => array(
                'drivers' => array(
                    'Application\Entity' => 'application_entities'
                )
            )))
);
