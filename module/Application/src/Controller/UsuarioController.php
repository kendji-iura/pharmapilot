<?php

namespace Application\Controller;

use Application\Model\Usuario;
use Zend\Hydrator\ClassMethods;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zend\Mvc\Controller\AbstractActionController;

class UsuarioController extends AbstractActionController
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
            "usuarios" => $this->repository->findBy(['ativo' => 1])
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
        $data['senha'] = password_hash($data['senha'],PASSWORD_DEFAULT);

        $classMethods = new ClassMethods();
        $usuario = new Usuario();

        $classMethods->hydrate($data, $usuario);

        $this->entityManager->persist($usuario);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('admin/usuario');
    }

    public function editAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id || !($usuario = $this->repository->find($id))) {
            return $this->redirect()->toRoute('admin/usuario');
        }

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return new ViewModel([
                "usuario" => $usuario,
            ]);
        }

            $data = $request->getPost();

            $classMethods = new ClassMethods();
            $classMethods->hydrate($data->toArray(), $usuario);

            $this->entityManager->persist($usuario);
            $this->entityManager->flush();

        return $this->redirect()->toRoute('admin/usuario');
        
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id || !($usuario = $this->repository->find($id))) {
            return $this->redirect()->toRoute('admin/usuario');
        }
        
        $usuario->setAtivo(0);

        $this->entityManager->persist($usuario);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('admin/usuario');

    }

}
