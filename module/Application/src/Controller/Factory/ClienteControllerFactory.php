<?php

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Application\Controller\ClienteController;
use Application\Model\Cliente;
use Doctrine\ORM\EntityManager;

class ClienteControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $entityManager = $container->get(EntityManager::class);
        $repository = $entityManager->getRepository(Cliente::class);
        return new ClienteController(
            $entityManager,
            $repository,
        );
    }
}
