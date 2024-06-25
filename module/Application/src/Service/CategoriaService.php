<?php

namespace Application\Service;

use Application\Model\Categoria;
use Application\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManager;

class CategoriaService
{
    private $entityManager;
    private $categoriaRepository;

    public function __construct(EntityManager $entityManager, CategoriaRepository $categoriaRepository)
    {
        $this->entityManager = $entityManager;
        $this->categoriaRepository = $categoriaRepository;
    }

    public function findAll()
    {
        return $this->categoriaRepository->findAll();
    }

    public function find($id)
    {
        return $this->categoriaRepository->find($id);
    }

    public function create(array $data)
    {
        $categoria = new Categoria();
        $categoria->setNome($data['nome']);

        $this->entityManager->persist($categoria);
        $this->entityManager->flush();

        return $categoria;
    }

    public function update(Categoria $categoria, array $data)
    {
        $categoria->setNome($data['nome']);

        $this->entityManager->persist($categoria);
        $this->entityManager->flush();

        return $categoria;
    }

    public function delete(Categoria $categoria)
    {
        $this->entityManager->remove($categoria);
        $this->entityManager->flush();
    }
}