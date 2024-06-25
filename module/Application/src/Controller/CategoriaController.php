<?php

namespace Application\Controller;

use Application\Model\Categoria;
use Application\Repository\CategoriaRepository;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;
use Zend\Mvc\Controller\AbstractActionController;

class CategoriaController extends AbstractActionController
{
    private $repository;

    private $entityManager;

    private $categoriaService;
    
    public function __construct(EntityManager $entityManager, CategoriaRepository $repository)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        return new ViewModel([
            "categorias" => $this->repository->findAll()
        ]);
    }

    public function insertAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel();
        }
        $data = $request->getPost();
        $data = $data->toArray();

        $classMethods = new ClassMethods();
        $categoria = new Categoria();

        $classMethods->hydrate($data, $categoria);

        $this->entityManager->persist($categoria);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('categoria');
    }

    public function editAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id || !($categoria = $this->repository->find($id))) {
            return $this->redirect()->toRoute('categoria');
        }
      
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return new ViewModel([
                "categoria" => $categoria,
            ]);
        }
            $data = $request->getPost();

            $classMethods = new ClassMethods();
            $classMethods->hydrate($data->toArray(), $categoria);
            
            $this->entityManager->persist($categoria);
            $this->entityManager->flush();

        return $this->redirect()->toRoute('categoria');
        
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id || !($categoria = $this->repository->find($id))) {
            return $this->redirect()->toRoute('categoria');
        }

        $this->entityManager->remove($categoria);
        $this->entityManager->flush();
        
        return $this->redirect()->toRoute('categoria');

    }

}
