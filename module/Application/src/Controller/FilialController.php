<?php

namespace Application\Controller;

use Application\Model\Filial;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zend\Hydrator\ClassMethods;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FilialController extends AbstractActionController
{
    private $repository;
    private $entityManager;

    public function __construct(EntityManager $entityManager, EntityRepository $repository)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        return new ViewModel([
            "filiais" => $this->repository->findBy(['ativo' => 1])
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
        $filial = new Filial();

        $classMethods->hydrate($data->toArray(), $filial);

        $this->entityManager->persist($filial);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('filial');
    }

    public function editAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id || !($filial = $this->repository->find($id))) {
            return $this->redirect()->toRoute('filial');
        }

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return new ViewModel([
                "filial" => $filial,
            ]);
        }

            $data = $request->getPost();

            $classMethods = new ClassMethods();
            $classMethods->hydrate($data->toArray(), $filial);

            $this->entityManager->persist($filial);
            $this->entityManager->flush();

        return $this->redirect()->toRoute('filial');
        
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id || !($filial = $this->repository->find($id))) {
            return $this->redirect()->toRoute('filial');
        }

        $filial->setAtivo(0);

        $this->entityManager->persist($filial);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('filial');

    }

}
