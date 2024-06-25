<?php

namespace Application\Repository;
use Application\Model\Filial;
use Doctrine\ORM\EntityRepository;

class FilialRepository extends EntityRepository
{
    public function findAllFiliais()
    {
        return $this->findAll();
    }

    public function findFilialById($id)
    {
        return $this->find($id);
    }

    public function insertFilial(Filial $filial)
    {
        $this->getEntityManager()->persist($filial);
        $this->getEntityManager()->flush();
    }

    public function updateFilial(Filial $filial)
    {
        $this->getEntityManager()->persist($filial);
        $this->getEntityManager()->flush();
    }

    public function deleteFilial(Filial $filial)
    {
        $this->getEntityManager()->remove($filial);
        $this->getEntityManager()->flush();
    }
}
