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

            'fixture' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/fixture',
                    'defaults' => [
                        'controller' => Controller\FixtureController::class,
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

            'lista-tabelas' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/tabela/lista-tabelas',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'listaTabelas',
                    ],
                ],
            ],

            'update-tabelas' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/tabela/update',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'updateTabelas',
                    ],
                ],
            ],

            'get-tabela' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/tabela/get[/:cd_registro]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'getTabela',
                        'cd_registro' => '0'
                    ],
                ],
            ],

            'delete-tabela' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/tabela/delete[/:cd_registro]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'deleteTabela',
                        'cd_registro' => '0'
                    ],
                ],
            ],

            'lista-tabelas-temporarias' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/tabela/lista-tabelas-temporarias',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'listaTabelasTemporarias',
                    ],
                ],
            ],

            'detalhes-tabela' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/tabela/detalhes[/:nr_tabela_id]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'detalhesTabela',
                        'nr_tabela_id' => '0'
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
            Controller\FixtureController::class => Factory\ControllerComServiceFactory::class,
        ]
    ],

    'service_manager' => [
        'factories' => [
            \Application\Service\ComandosSqlService::class => Factory\ComandosSqlServiceFactory::class,

            \Application\Service\Dql\TabelaDqlService::class => InvokableFactory::class,
            \Application\Service\Dql\CampoDqlService::class => InvokableFactory::class,

            \Application\Service\Repository\TabelaService::class => Factory\RepositoryFactory::class,
            \Application\Service\Repository\CampoService::class => Factory\RepositoryFactory::class,
            \Application\Service\Repository\TipoDeChaveService::class => Factory\RepositoryFactory::class,
            \Application\Service\Repository\TabelaChaveService::class => Factory\RepositoryFactory::class,
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

        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ],
];
