<?php

declare(strict_types=1);

namespace Application\Controller;

use DateTime;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Zend\Hydrator\ClassMethods;
use Application\Model\Orcamento;
use Doctrine\ORM\EntityRepository;
use Application\Model\OrcamentoProduto;
use Zend\Mvc\Controller\AbstractActionController;

class OrcamentoController extends AbstractActionController
{
    private $entityManager;
    private $repository;
    private $usuarios;
    private $clientes;
    private $filiais;
    private $produtos;
    private $lotes;
    private $orcamentoProdutos;
            
    public function __construct(
                EntityManager $entityManager,
                EntityRepository $repository,
                EntityRepository $usuarios,
                EntityRepository $clientes,
                EntityRepository $filiais,
                EntityRepository $produtos,
                EntityRepository $orcamentoProdutos,
                EntityRepository $lotes
                )
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->usuarios = $usuarios;
        $this->clientes = $clientes;
        $this->filiais = $filiais;
        $this->produtos = $produtos;
        $this->orcamentoProdutos = $orcamentoProdutos;
        $this->lotes = $lotes;
    }

    public function indexAction(string $filial = null)
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $filial = $data['filial'];
        }
        if (!$filial){
            $filial = 0;
        }

        $orcamentos = $this->repository->findAll();
        if ($filial !== 0) {
            $orcamentos = $this->repository->findBy(['filial' => $filial]);
        }
        return new ViewModel([
            'orcamentos' => $orcamentos,
            'clientes' => $this->clientes->findAll(),
            'filiais' => $this->filiais->findAll(),
            'filial' => $filial,
        ]);
    }

    public function insertAction()
    {
        
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel([
                'clientes' => $this->clientes->findAll(),
                'filiais' => $this->filiais->findAll(),
            ]);
        }

        $data = $request->getPost();
        $data = $data->toArray();

        $data['valor'] = !$data['valor'] ? 0 : $data['valor'];
        $data['acrescimo'] = !$data['acrescimo'] ? 0 : $data['acrescimo'];
        $data['desconto'] = !$data['desconto'] ? 0 : $data['desconto'];
        $data['usuario'] = $this->usuarios->findOneBy(['id' => $data['usuario']]);
        $data['cliente'] = $this->clientes->findOneBy(['id' => $data['cliente']]);
        $data['filial'] = $this->filiais->findOneBy(['id' => $data['filial']]);
        $data['data'] = new DateTime($data['data']);

        $classMethods = new ClassMethods();
        $orcamento = new Orcamento();

        $classMethods->hydrate($data, $orcamento);

        $this->entityManager->persist($orcamento);
        $this->entityManager->flush();

        return $this->redirect()->toRoute('orcamento', [
            'action' => 'edit',
            'id' => $orcamento->getId(),
        ], ['query' => ['showModal' => 'true']]);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id || !($orcamento = $this->repository->find($id))) {
            return $this->redirect()->toRoute('orcamento');
        }
        
        $request = $this->getRequest();

        //dd($this->orcamentoProdutos->findBy(['orcamento' => $orcamento]));

        if (!$request->isPost()) {
            return new ViewModel([
                "orcamento" => $orcamento,
                "orcamentoProdutos" => $this->orcamentoProdutos->findBy(['orcamento' => $orcamento]),
                "clientes" => $this->clientes->findAll(),
                'filiais' => $this->filiais->findAll(),
                'produtos' => $this->produtos->findAll(),
            ]);
        }

            $data = $request->getPost();
            $data['acrescimo'] = !$data['acrescimo'] ? 0 : $data['acrescimo'];
            $data['desconto'] = !$data['desconto'] ? 0 : $data['desconto'];
            $data['usuario'] = $this->usuarios->findOneBy(['id' => $data['usuario']]);
            $data['cliente'] = $this->clientes->findOneBy(['id' => $data['cliente']]);
            $data['filial'] = $this->filiais->findOneBy(['id' => $data['filial']]);
            $data['data'] = new DateTime($data['data']);
            $data['valor'] = $this->orcamentoProdutos->getValorTotal($orcamento);

            $data = $data->toArray();

            $classMethods = new ClassMethods();
            $classMethods->hydrate($data, $orcamento);

            $this->entityManager->persist($orcamento);
            $this->entityManager->flush();

        return $this->redirect()->toRoute('orcamento', ['action' => 'edit', 'id' => $orcamento->getId()]);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('orcamento');
        }
        $this->table->delete($id);
        return $this->redirect()->toRoute('orcamento');
    }

    public function getLotesAction()
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'application/json'
        ]);

        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id || !($orcamento = $this->repository->find($id))) {
            $response->setContent(json_encode([]));
            return $response;
        }
        
        $lotes = $this->lotes->findBy(['filial' => $orcamento->getFilial()->getId()]);
        $lotesJson = [];

        $itens = [];
        foreach ($lotes as $item) {
            if (!array_search($item->getProduto()->getId(), $itens)) {
                $orcamentoProduto = $this->orcamentoProdutos->findOneBy([
                    'orcamento' => $orcamento,
                    'produto' => $this->produtos->find($item->getProduto()->getId()),
                ]);

                $quantidade = $orcamentoProduto ? $orcamentoProduto->getQuantidade() : 0;

                $lotesJson[] = [
                    'produto_id' => $item->getProduto()->getId(),
                    'produto' => $item->getProduto()->getNome(),
                    'valor' => $item->getProduto()->getValor() * $item->getProduto()->getMargem(),
                    'quantidadeDisp' => $item->getQuantidade(),
                    'quantidade' => $quantidade,
                ];
                $itens[$item->getProduto()->getId()] = $item->getProduto()->getId();
        }
        }

        $data = [
            'draw' => (int) $this->params()->fromQuery('draw', 0),
            'recordsTotal' => count($lotesJson),
            'recordsFiltered' => count($lotesJson),
            'data' => $lotesJson,
        ];

        $response->setContent(json_encode($data));
        return $response;
    }

    public function insertProdutosAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        if (!$request->isPost()) {
            $response->setStatusCode(405);
            $response->setContent(json_encode(['success' => false, 'error' => 'Método de requisição inválido']));
            return $response;
        }

        $data = json_decode($request->getContent(), true);

        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            $response->setStatusCode(400);
            $response->setContent(json_encode(['success' => false, 'error' => 'Erro ao decodificar JSON']));
            return $response;
        }

        foreach ($data['produtos'] as $item) {

            if (!($orcamentoProduto = $this->orcamentoProdutos->findOneBy([
                'orcamento' => $data['orcamento'],
                'produto' => $item['produto_id'],
            ]))) {
                $orcamentoProduto = new OrcamentoProduto();
            }

            if ($item['quantidade'] > 0) {
                $pedido = [
                    'orcamento' => $this->repository->find($data['orcamento']),
                    'produto' => $this->produtos->find($item['produto_id']),
                    'quantidade' => $item['quantidade'],
                ];

                $classMethods = new ClassMethods();
                $classMethods->hydrate($pedido, $orcamentoProduto);
                $this->entityManager->persist($orcamentoProduto);
                
            } else {
                    $this->entityManager->remove($orcamentoProduto);
            }
            $this->entityManager->flush();
        }
        // $response->setContent(json_encode($pedido));
        return $response;

    }

    public function translateStatusAction($input) {
        if (!(is_string($input) || is_int($input)))
        {
            return null;
        }
        if (is_string($input))
        {
            switch ($input) {
                case 'value':
                    # code...
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}