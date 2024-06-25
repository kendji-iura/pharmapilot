<?php

declare(strict_types=1);

namespace Application\Controller;


use Application\Model\Produto;
use Zend\Hydrator\ClassMethods;
use Zend\View\Model\ViewModel;
use Application\Model\ProdutoTable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zend\Mvc\Controller\AbstractActionController;

class ProdutoController extends AbstractActionController
{
    private $entityManager;
    private $repository;
    private $categorias;
            
    public function __construct(EntityManager $entityManager, EntityRepository $repository, EntityRepository $categorias)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->categorias = $categorias;
    }

    public function indexAction()
    {
        return new ViewModel([
            "produtos" => $this->repository->findBy(['ativo' => 1]),
            "categorias" => $this->categorias->findAll(),
        ]);
    }

    public function insertAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel(['categorias' => $this->categorias->findAll(),]);
        }

        $data = $request->getPost();
        $data = $data->toArray();

        if($_FILES["imagem"]["name"]){
        $last = $this->repository->findOneBy([], ['id' => 'DESC'])->getId()+1;
        $ext = strtolower(pathinfo(basename($_FILES["imagem"]["name"]),PATHINFO_EXTENSION));
        $target_file = dirname(__DIR__, 4).'/public/img/produtos/' . $last . '.' . $ext;
        if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
            echo "Erro ao salvar arquivo.";
        }
        $data["imagem"] = "/img/produtos/" . $last . '.' . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        }
        
        $data['categoria'] = $this->categorias->findOneBy(['id' => $data['categoria']]);

        $classMethods = new ClassMethods();
        $produto = new Produto();

        $classMethods->hydrate($data, $produto);

        $this->entityManager->persist($produto);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('produto');
    }

    public function editAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id || !($produto = $this->repository->find($id))) {
            return $this->redirect()->toRoute('produto');
        }
        
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return new ViewModel([
                "produto" => $produto,
                'categorias' => $this->categorias->findAll(),
            ]);
        }
            $data = $request->getPost();
            $data = $data->toArray();

            if($_FILES["imagem"]["name"]){
            $ext = strtolower(pathinfo(basename($_FILES["imagem"]["name"]),PATHINFO_EXTENSION));
            $target_file = dirname(__DIR__, 4).'/public/img/produtos/' . $id . '.' . $ext;
            if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                echo "Erro ao salvar arquivo.";
              }
            $data["imagem"] = "/img/produtos/" . $id . '.' . strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            $produto->setImagem = $data['imagem'];
            }

            $data['categoria'] = $this->categorias->findOneBy(['id' => $data['categoria']]);

            $classMethods = new ClassMethods();
            $classMethods->hydrate($data, $produto);

            $this->entityManager->persist($produto);
            $this->entityManager->flush();

        return $this->redirect()->toRoute('produto');
        
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id || !($produto = $this->repository->find($id))) {
            return $this->redirect()->toRoute('produto');
        }

        $produto->setAtivo(false);

        $this->entityManager->persist($produto);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('produto');
    }
}
