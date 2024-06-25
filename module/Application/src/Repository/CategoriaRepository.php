<?php

namespace Application\Repository;

use Application\Model\Categoria;
use Doctrine\ORM\EntityRepository;

class CategoriaRepository extends EntityRepository
{
    public function findAllCategorias()
    {
        return $this->findAll();
    }

    public function findCategoriaById($id)
    {
        return $this->find($id);
    }

    public function insertCategoria(Categoria $categoria)
    {
        $this->getEntityManager()->persist($categoria);
        $this->getEntityManager()->flush();
    }

    public function updateCategoria(Categoria $categoria)
    {
        $this->getEntityManager()->persist($categoria);
        $this->getEntityManager()->flush();
    }

    public function deleteCategoria(Categoria $categoria)
    {
        $this->getEntityManager()->remove($categoria);
        $this->getEntityManager()->flush();
    }
}
