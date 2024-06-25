<?php

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Application\Controller\FilialController;
use Application\Model\Filial;
use Doctrine\ORM\EntityManager;

class FilialControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $entityManager = $container->get(EntityManager::class);
        $repository = $entityManager->getRepository(Filial::class);
        return new FilialController(
            $entityManager,
            $repository,
        );
    }
}
