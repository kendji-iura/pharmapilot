<?php

declare(strict_types=1);

namespace Application\Controller;

use DateTime;
use Application\Model\Lote;
use Application\Model\Produto;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;
use Application\Model\LoteTable;
use Doctrine\ORM\EntityRepository;
use Zend\Mvc\Controller\AbstractActionController;

class LoteController extends AbstractActionController
{
    private $entityManager;
    private $repository;
    private $produtos;
    private $filiais;
            
    public function __construct(EntityManager $entityManager, EntityRepository $Repository, EntityRepository $produtos, EntityRepository $filiais)
    {
        $this->entityManager = $entityManager;
        $this->repository = $Repository;
        $this->produtos = $produtos;
        $this->filiais = $filiais;
    }

    public function indexAction()
    {
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $filial = $data['filial'];
        }
        if (!$filial){
            $filial = 0;
        }
        $lotes = $this->repository->findAll();
        if ($filial !== 0) {
            $lotes = $this->repository->findBy(['filial' => $filial]);
        }
        return new ViewModel([
            'lotes' => $lotes,
            'filiais' => $this->filiais->findAll(),
            'filial' => $filial,
        ]);
    }

    public function insertAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel([
                'produtos' => $this->produtos->findAll(),
                'filiais' => $this->filiais->findAll(),
            ]);
        }

        $data = $request->getPost();
        $data = $data->toArray();

        $data['filial'] = $this->filiais->findOneBy(['id' => $data['filial']]);
        $data['produto'] = $this->produtos->findOneBy(['id' => $data['produto']]);
        $data['entrada'] = new DateTime($data['entrada']);
        $data['validade'] = new DateTime($data['validade']);

        $classMethods = new ClassMethods();
        $lote = new Lote();

        $classMethods->hydrate($data, $lote);

        $this->entityManager->persist($lote);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('lote');
    }

    public function editAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id || !($lote = $this->repository->find($id))) {
            return $this->redirect()->toRoute('lote');
        }

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return new ViewModel([
                "lote" => $lote,
                "produtos" => $this->produtos->findAll(),
                'filiais' => $this->filiais->findAll(),
            ]);
        }
            $data = $request->getPost();
            $data = $data->toArray();
           
            $data['filial'] = $this->filiais->findOneBy(['id' => $data['filial']]);
            $data['produto'] = $this->produtos->findOneBy(['id' => $data['produto']]);
            $data['entrada'] = new DateTime($data['entrada']);
            $data['validade'] = new DateTime($data['validade']);

            $classMethods = new ClassMethods();
            $classMethods->hydrate($data, $lote);

            $this->entityManager->persist($lote);
            $this->entityManager->flush();

        return $this->redirect()->toRoute('lote');
        
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id || !($lote = $this->repository->find($id))) {
            return $this->redirect()->toRoute('lote');
        }

        $this->entityManager->remove($lote);
        $this->entityManager->flush();
        return $this->redirect()->toRoute('lote');
    }
}
