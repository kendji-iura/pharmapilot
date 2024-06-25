<?php

namespace Application\Repository;

use Application\Model\Orcamento;
use Doctrine\ORM\EntityRepository;
use Application\Model\OrcamentoProduto;

/**
 * @EntityRepository
 * 
*/

class OrcamentoProdutoRepository extends EntityRepository
{
    public function __construct($entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata(OrcamentoProduto::class));
    }
    
    public function findAllOrcamentoProdutos()
    {
        return $this->findAll();
    }

    public function findOrcamentoProdutoById($id)
    {
        return $this->find($id);
    }

    public function insertOrcamentoProduto(OrcamentoProduto$orcamentoProduto)
    {
        $this->getEntityManager()->persist($orcamentoProduto);
        $this->getEntityManager()->flush();
    }

    public function updateOrcamentoProduto(OrcamentoProduto$orcamentoProduto)
    {
        $this->getEntityManager()->persist($orcamentoProduto);
        $this->getEntityManager()->flush();
    }

    public function deleteOrcamentoProduto(OrcamentoProduto$orcamentoProduto)
    {
        $this->getEntityManager()->remove($orcamentoProduto);
        $this->getEntityManager()->flush();
    }

    /**
     * Calcula a soma do valor total dos produtos por orçamento
     *
     * @param  $orcamento
     * 
     * @return  float
     */ 
    public function getValorTotal($orcamento)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('SUM(p.valor * op.quantidade) as total')
            ->from(OrcamentoProduto::class, 'op')
            ->leftJoin('op.produto', 'p')
            ->where('op.orcamento = :orcamento_id')
            ->setParameter('orcamento_id', $orcamento);
    
            $result = $qb->getQuery()->getSingleScalarResult();

        return $result ?: 0;
    }
}
