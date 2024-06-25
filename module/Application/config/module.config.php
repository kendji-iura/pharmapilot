<?php

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Application\Service\UserService;
use Application\Service\CategoriaService;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\ServiceManager\Factory\InvokableFactory;
use Application\Service\Factory\UserServiceFactory;
use Zend\Authentication\AuthenticationServiceInterface;
use Application\Controller\Factory\AuthControllerFactory;
use Application\Controller\Factory\LoteControllerFactory;
use Application\Controller\Factory\FilialControllerFactory;
use Application\Controller\Factory\ClienteControllerFactory;
use Application\Controller\Factory\EstoqueControllerFactory;
use Application\Controller\Factory\ProdutoControllerFactory;
use Application\Controller\Factory\UsuarioControllerFactory;
use Application\Service\Factory\AuthenticationServiceFactory;
use Application\Controller\Factory\CategoriaControllerFactory;
use Application\Controller\Factory\OrcamentoControllerFactory;


return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/home/[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin'
                ], 
                'may_terminate' => false,
                'child_routes' => [
                    'usuario' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/usuario[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
                                ],
                            'defaults' => [
                                'controller' => Controller\UsuarioController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                ],
            ],
            
            'filial' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/filial[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        ],
                    'defaults' => [
                        'controller' => Controller\FilialController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'cliente' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/cliente[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        ],
                    'defaults' => [
                        'controller' => Controller\ClienteController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'categoria' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/categoria[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        ],
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'produto' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/produto[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        ],
                    'defaults' => [
                        'controller' => Controller\ProdutoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'estoque' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/estoque[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        ],
                    'defaults' => [
                        'controller' => Controller\EstoqueController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'lote' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/lote[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        ],
                    'defaults' => [
                        'controller' => Controller\LoteController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'orcamento' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/orcamento[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        ],
                    'defaults' => [
                        'controller' => Controller\OrcamentoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'login' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'logout' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\UsuarioController::class => UsuarioControllerFactory::class,
            Controller\FilialController::class => FilialControllerFactory::class,
            Controller\ClienteController::class => ClienteControllerFactory::class,
            Controller\CategoriaController::class => CategoriaControllerFactory::class,
            Controller\ProdutoController::class => ProdutoControllerFactory::class,
            Controller\AuthController::class => AuthControllerFactory::class,
            Controller\EstoqueController::class => EstoqueControllerFactory::class,
            Controller\LoteController::class => LoteControllerFactory::class,
            Controller\OrcamentoController::class => OrcamentoControllerFactory::class,
        ],
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
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
    'driver' => [
        'Application_driver' => [
            'class' => AnnotationDriver::class,
            'cache' => 'array',
            'paths' => [
                __DIR__.'/../src/Model',
                __DIR__.'/../src/Repository',
            ],
        ],
        'orm_default' => [
            'drivers' => [
                'Application\Model' => 'Application_driver',
                'Application\Repository' => 'Application_driver',
            ],
        ],
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'userService' => UserService::class,
        ],
        'factories' => [
            UserService::class => UserServiceFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            CategoriaService::class => function($container) {
                $entityManager = $container->get(\Doctrine\ORM\EntityManager::class);
                $categoriaRepository = $entityManager->getRepository(\Application\Model\Categoria::class);
                return new CategoriaService($entityManager, $categoriaRepository);
            },
            AuthenticationServiceInterface::class => AuthenticationServiceFactory::class,
        ],
    ],


];
