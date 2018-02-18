<?php
namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [

  'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],

    'router' => [
        'routes' => [

            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'ler-sql' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/ler-sql',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'lerSql',
                    ],
                ],
            ],

            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Factory\ControllerComServiceFactory::class,
        ]
    ],

    'service_manager' => [
        'factories' => [
            \Application\Service\ComandosSqlService::class => Factory\ComandosSqlServiceFactory::class,
        ],

        /*'invokables' => [
            Controller\IndexController::class => Factory\ControllerComServiceFactory::class,
        ],*/
        /*'services' => [
            Controller\IndexController::class => Factory\ControllerComServiceFactory::class,
        ],  */
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',

        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            // 'application/index/ler-sql' => __DIR__ . '/../view/application/ler-sql/ler-sql.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],

        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];