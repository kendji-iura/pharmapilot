<?php

namespace Application\Repository;
use Doctrine\ORM\EntityRepository;
use Application\Model\Usuario;

class UsuarioRepository extends EntityRepository
{
    public function findAllUsuarios()
    {
        return $this->findAll();
    }

    public function findUsuarioById($id)
    {
        return $this->find($id);
    }

    public function insertUsuario(Usuario $usuario)
    {
        $this->getEntityManager()->persist($usuario);
        $this->getEntityManager()->flush();
    }

    public function updateUsuario(Usuario $usuario)
    {
        $this->getEntityManager()->persist($usuario);
        $this->getEntityManager()->flush();
    }

    public function deleteUsuario(Usuario $usuario)
    {
        $this->getEntityManager()->remove($usuario);
        $this->getEntityManager()->flush();
    }
}
