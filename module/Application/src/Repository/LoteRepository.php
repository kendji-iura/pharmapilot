<?php

namespace Application\Repository;
use Application\Model\Orcamento;
use Doctrine\ORM\EntityRepository;

class LoteRepository extends EntityRepository
{
    public function getLotesByFilial($filialId)
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT l FROM Application\Model\Lote l WHERE l.filial = :filialId'
        );
        $query->setParameter('filialId', $filialId);
        return $query->getResult();
    }

    public function findAllOrcamentos()
    {
        return $this->findAll();
    }

    public function findOrcamentoById($id)
    {
        return $this->find($id);
    }

    public function insertOrcamento(Orcamento $orcamento)
    {
        $this->getEntityManager()->persist($orcamento);
        $this->getEntityManager()->flush();
    }

    public function updateOrcamento(Orcamento $orcamento)
    {
        $this->getEntityManager()->persist($orcamento);
        $this->getEntityManager()->flush();
    }

    public function deleteOrcamento(Orcamento $orcamento)
    {
        $this->getEntityManager()->remove($orcamento);
        $this->getEntityManager()->flush();
    }
}
