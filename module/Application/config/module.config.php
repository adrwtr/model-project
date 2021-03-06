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

            'teste' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/teste',
                    'defaults' => [
                        'controller' => Controller\TesteController::class,
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

            'sistema-admin-tabela' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/sistema/administrar[/:nr_registro]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'sistemaAdminTabela',
                        'nr_registro' => '0'
                    ],
                ],
            ],

            'relatorio-sistemas' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/sistema/relatorio[/:nr_registro]',
                    'defaults' => [
                        'controller' => Controller\RelatorioController::class,
                        'action'     => 'relatorioSistema',
                    ],
                ],
            ],


            ////////////////////
            // SQL

            'index-sql' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/sql',
                    'defaults' => [
                        'controller' => Controller\SqlController::class,
                        'action'     => 'sql',
                    ],
                ],
            ],

            'lista-conexoes' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/sql/lista-conexao',
                    'defaults' => [
                        'controller' => Controller\SqlController::class,
                        'action'     => 'listaConexao',
                    ],
                ],
            ],

            'lista-database' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/sql/lista-database',
                    'defaults' => [
                        'controller' => Controller\SqlController::class,
                        'action'     => 'listaDatabase',
                    ],
                ],
            ],

            'sql-lista-all-campos' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/sql/lista-all-campos',
                    'defaults' => [
                        'controller' => Controller\SqlController::class,
                        'action'     => 'listaAllCampos',
                    ],
                ],
            ],

            'sql-executa' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/sql/executa',
                    'defaults' => [
                        'controller' => Controller\SqlController::class,
                        'action'     => 'executa',
                    ],
                ],
            ],

            'sql-popup-executado' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/sql/popup-executado',
                    'defaults' => [
                        'controller' => Controller\SqlController::class,
                        'action'     => 'popupExecutado',
                    ],
                ],
            ],







            'index-tabela' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/tabela',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'indexTabela',
                    ],
                ],
            ],

            'lista-sistemas' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/sistema/lista-sistemas',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'listaSistemas',
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

            'merge-tabelas' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/tabela/merge',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'mergeTabelas',
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

            'get-tabela-campos' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/tabela/campos/get[/:cd_registro]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'getTabelaCampos',
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

            'get-tabela-repetida' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/tabela/repetida/get',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'getTabelaRepetida',
                        'cd_registro' => '0'
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
            Controller\RelatorioController::class => Factory\ControllerComServiceFactory::class,
            Controller\SqlController::class => Factory\ControllerComServiceFactory::class,
            Controller\FixtureController::class => Factory\ControllerComServiceFactory::class,
            Controller\TesteController::class => Factory\ControllerComServiceFactory::class,
        ]
    ],

    'service_manager' => [
        'factories' => [

            \Application\Service\ComandosSqlService::class => Factory\ComandosSqlServiceFactory::class,
            \Application\Service\InserirPorArrayService::class => Factory\InserirPorArrayServiceFactory::class,

            \Application\Service\Dql\TabelaDqlService::class => InvokableFactory::class,
            \Application\Service\Dql\CampoDqlService::class => InvokableFactory::class,
            \Application\Service\Dql\TabelaChaveDqlService::class => InvokableFactory::class,
            \Application\Service\Dql\TipoDeChaveDqlService::class => InvokableFactory::class,
            \Application\Service\Dql\SistemaDqlService::class => InvokableFactory::class,
            \Application\Service\Dql\RelatorioDqlService::class => InvokableFactory::class,
            \Application\Service\Dql\ConexaoDqlService::class => InvokableFactory::class,


            \Application\Service\Repository\TabelaService::class => Factory\RepositoryFactory::class,
            \Application\Service\Repository\CampoService::class => Factory\RepositoryFactory::class,
            \Application\Service\Repository\TipoDeChaveService::class => Factory\RepositoryFactory::class,
            \Application\Service\Repository\TabelaChaveService::class => Factory\RepositoryFactory::class,

            \Application\Service\Mysql\MysqlService::class => InvokableFactory::class,
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
