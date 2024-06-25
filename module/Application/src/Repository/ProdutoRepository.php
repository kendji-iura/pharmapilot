<?php

namespace Application\Repository;

use Application\Model\Produto;
use Doctrine\ORM\EntityRepository;

class ProdutoRepository extends EntityRepository
{
    public function findAllProdutos()
    {
        return $this->findAll();
    }

    public function findProdutoById($id)
    {
        return $this->find($id);
    }

    public function insertProduto(Produto $produto)
    {
        $this->getEntityManager()->persist($produto);
        $this->getEntityManager()->flush();
    }

    public function updateProduto(Produto $produto)
    {
        $this->getEntityManager()->persist($produto);
        $this->getEntityManager()->flush();
    }

    public function deleteProduto(Produto $produto)
    {
        $this->getEntityManager()->remove($produto);
        $this->getEntityManager()->flush();
    }
}
