<?php

declare(strict_types=1);

namespace Application\Controller;


use Zend\Http\Request;
use Zend\Db\Adapter\Adapter;
use Zend\View\Model\ViewModel;
use Application\Model\FilialTable;
use Application\Model\EstoqueTable;
use Application\Model\Filial;
use Application\Model\ProdutoTable;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zend\Mvc\Controller\AbstractActionController;

class EstoqueController extends AbstractActionController
{
    /**
     * @var EstoqueTable
     */
    private $entityManager;
    private $repository;
    private $filiais;
    private $produtos;
            
    public function __construct(EntityManager $entityManager, EntityRepository $repository, EntityRepository $filiais, EntityRepository $produtos)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->filiais = $filiais;
        $this->produtos = $produtos;
    }

    public function indexAction()
    {   
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $filial = $data['filial'];
        }
        
        if ($filial && $filial != 0){
            $result = $this->repository->findBy(['filial' => $filial]);
        }
        if (!$filial || $filial == 0){
            $result = $this->repository->findAll();
        }
        
        $estoque = [];
        $validades = [];
        $quantidades = [];

        foreach ($result as $item) {

            $validades[$item->getProduto()->getId()] = ($validades[$item->getProduto()->getId()] && $validades[$item->getProduto()->getId()] < $item->getValidade()) ? $validades[$item->getProduto()->getId()] : $item->getValidade();
            $estoque[$item->getProduto()->getId()] = [
                'produto' => $item->getProduto()->getNome(),
                'filial' => $item->getFilial()->getId(),
                'quantidade' => $estoque[$item->getProduto()->getId()]['quantidade'] + $item->getQuantidade(),
                'validade' => $validades[$item->getProduto()->getId()],
            ];
            
            }

        return new ViewModel([
            'estoque' => $estoque,
            'filiais' => $this->filiais->findAll(),
            'filial' => $filial,
        ]);
    }

}
