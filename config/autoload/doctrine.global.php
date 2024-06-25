<?php

use Application\Model\Usuario;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\Driver\PDO\MySQL\Driver;

return [
   'doctrine' => [
       'connection' => [
           'orm_default' => [
               'driverClass' => Driver::class,
               'params' => [
                   'host' => '172.20.0.4',
               ],
           ]
        ],
    'authentication' => [
        'orm_default' => [
            'object_manager' => EntityManager::class,
            'identity_class' => Usuario::class,
            'identity_property' => 'email',
            'credential_property' => 'senha',
            'credential_callable' => function (Usuario $usuario, $passwordSent) {
                return password_verify($passwordSent, $usuario->getSenha());
            }
        ]
    ]
    ],
];
