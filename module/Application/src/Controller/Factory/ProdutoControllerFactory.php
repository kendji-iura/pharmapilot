<?php

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Application\Model\Categoria;
use Application\Controller\ProdutoController;
use Application\Model\Produto;
use Doctrine\ORM\EntityManager;

class ProdutoControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $entityManager = $container->get(EntityManager::class);
        $repository = $entityManager->getRepository(Produto::class);
        $categorias = $entityManager->getRepository(Categoria::class);
        return new ProdutoController(
            $entityManager,
            $repository,
            $categorias,
        );
    }
}
