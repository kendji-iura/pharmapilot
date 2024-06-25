<?php

namespace Application\Controller\Factory;

use Doctrine\ORM\EntityManager;
use Application\Model\Categoria;
use Interop\Container\ContainerInterface;
use Application\Controller\CategoriaController;

class CategoriaControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /**
         * @var EntityManager $entityManager
         */
        $entityManager = $container->get(EntityManager::class);
        $repository = $entityManager->getRepository(Categoria::class);
        return new CategoriaController(
            $entityManager,
            $repository
        );
    }
}
