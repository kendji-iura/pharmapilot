<?php

namespace Application\Controller\Factory;

use Application\Model\Lote;
use Doctrine\ORM\EntityManager;
use Application\Model\Filial;
use Application\Model\Produto;
use Interop\Container\ContainerInterface;
use Application\Controller\LoteController;

class LoteControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $entityManager = $container->get(EntityManager::class);
        $repository = $entityManager->getRepository(Lote::class);
        $produtos = $entityManager->getRepository(Produto::class);
        $filiais = $entityManager->getRepository(Filial::class);
        return new LoteController(
            $entityManager,
            $repository,
            $produtos,
            $filiais,
        );
    }
}
