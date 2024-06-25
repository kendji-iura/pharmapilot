<?php

namespace Application\Controller\Factory;

use Application\Model\Lote;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Application\Controller\EstoqueController;
use Application\Model\Filial;
use Application\Model\Produto;

class EstoqueControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
            $entityManager = $container->get(EntityManager::class);
            $repository = $entityManager->getRepository(Lote::class);
            $filiais = $entityManager->getRepository(Filial::class);
            $produtos = $entityManager->getRepository(Produto::class);

        return new EstoqueController(
            $entityManager,
            $repository,
            $filiais,
            $produtos,
        );
    }
}
