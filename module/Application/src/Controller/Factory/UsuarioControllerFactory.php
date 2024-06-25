<?php

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Application\Controller\UsuarioController;
use Application\Model\Usuario;
use Doctrine\ORM\EntityManager;

class UsuarioControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $entityManager = $container->get(EntityManager::class);
        $repository = $entityManager->getRepository(Usuario::class);
        return new UsuarioController(
            $entityManager,
            $repository,
        );
    }
}
