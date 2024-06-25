<?php

namespace Application\Controller;

use Application\Model\Cliente;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;
use Doctrine\ORM\EntityRepository;
use Zend\Mvc\Controller\AbstractActionController;

class ClienteController extends AbstractActionController
{
    
    private $entityManager;
    private $repository;

    public function __construct(EntityManager $entityManager, EntityRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function indexAction()
    {
        return new ViewModel([
            "clientes" => $this->repository->findAll(),
        ]);
    }

    public function insertAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel();
        }
        $data = $request->getPost();

        $classMethods = new ClassMethods();
        $cliente = new Cliente();

        $classMethods->hydrate($data->toArray(), $cliente);

        $this->entityManager->persist($cliente);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('cliente');
    }

    public function editAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id || !($cliente = $this->repository->find($id))) {
            return $this->redirect()->toRoute('cliente');
        }
        
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return new ViewModel([
                "cliente" => $cliente,
            ]);
        }
            $data = $request->getPost();

            $classMethods = new ClassMethods();
            $classMethods->hydrate($data->toArray(), $cliente);

            $this->entityManager->persist($cliente);
            $this->entityManager->flush();

        return $this->redirect()->toRoute('cliente');
        
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id || !($cliente = $this->repository->find($id))) {
            return $this->redirect()->toRoute('cliente');
        }
        $this->entityManager->remove($cliente);
        $this->entityManager->flush();
        return $this->redirect()->toRoute('cliente');

    }

}
