<?php

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Application\Controller\OrcamentoController;
use Application\Model\Cliente;
use Application\Model\Filial;
use Application\Model\Lote;
use Application\Model\Orcamento;
use Application\Model\OrcamentoProduto;
use Application\Model\Produto;
use Application\Model\Usuario;
use Doctrine\ORM\EntityManager;

class OrcamentoControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $entityManager = $container->get(EntityManager::class);
        $respository = $entityManager->getRepository(Orcamento::class);
        $usuarios = $entityManager->getRepository(Usuario::class);
        $clientes = $entityManager->getRepository(Cliente::class);
        $filiais = $entityManager->getRepository(Filial::class);
        $produtos = $entityManager->getRepository(Produto::class);
        $orcamentoProdutos = $entityManager->getRepository(OrcamentoProduto::class);
        $lotes = $entityManager->getRepository(Lote::class);
        return new OrcamentoController(
            $entityManager,
            $respository,
            $usuarios,
            $clientes,
            $filiais,
            $produtos,
            $orcamentoProdutos,
            $lotes,
        );
    }
}
