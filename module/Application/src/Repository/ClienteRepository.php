<?php

namespace Application\Repository;

use Application\Model\Cliente;
use Doctrine\ORM\EntityRepository;

class ClienteRepository extends EntityRepository
{
    public function findAllClientes()
    {
        return $this->findAll();
    }

    public function findClienteById($id)
    {
        return $this->find($id);
    }

    public function insertCliente(Cliente $cliente)
    {
        $this->getEntityManager()->persist($cliente);
        $this->getEntityManager()->flush();
    }

    public function updateCliente(Cliente $cliente)
    {
        $this->getEntityManager()->persist($cliente);
        $this->getEntityManager()->flush();
    }

    public function deleteCliente(Cliente $cliente)
    {
        $this->getEntityManager()->remove($cliente);
        $this->getEntityManager()->flush();
    }
}
