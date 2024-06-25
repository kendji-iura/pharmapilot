<?php

use Application\Controller\CategoriaController;
use Application\Model\Categoria;
use Application\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Zend\Hydrator\ClassMethods;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\Controller\PluginManager;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\View\Model\ViewModel;


class CategoriaControllerTest extends TestCase
{
    private $controller;
    private $entityManager;
    private $repository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManager::class);
        $this->repository = $this->createMock(CategoriaRepository::class);

        $this->controller = new CategoriaController($this->entityManager, $this->repository);
    }

    public function testIndexAction()
    {
        $categorias = [new Categoria(), new Categoria()];

        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($categorias);

        $viewModel = $this->controller->indexAction();

        $this->assertInstanceOf(ViewModel::class, $viewModel);
        $this->assertEquals($categorias, $viewModel->getVariable('categorias'));
    }

    public function testInsertAction()
    {
        $request = new Request();
        $request->setMethod(Request::METHOD_POST);
        $request->setPost(new \Zend\Stdlib\Parameters(['name' => 'Category 1']));

        $this->controller->dispatch($request);

        $this->entityManager->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Categoria::class));

        $this->entityManager->expects($this->once())
            ->method('flush');

        $response = $this->controller->getResponse();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('categoria', $response->getHeaders()->get('Location')->getFieldValue());
    }

    public function testEditAction()
    {
        $categoria = new Categoria();
        $categoria->setName('Category 1');

        $this->repository->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($categoria);

        $request = new Request();
        $request->setMethod(Request::METHOD_POST);
        $request->setPost(new \Zend\Stdlib\Parameters(['name' => 'Category 2']));

        $this->controller->dispatch($request);

        $this->entityManager->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($categoria));

        $this->entityManager->expects($this->once())
            ->method('flush');

        $response = $this->controller->getResponse();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('categoria', $response->getHeaders()->get('Location')->getFieldValue());
    }

    public function testDeleteAction()
    {
        $categoria = new Categoria();

        $this->repository->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn($categoria);

        $this->entityManager->expects($this->once())
            ->method('remove')
            ->with($this->equalTo($categoria));

        $this->entityManager->expects($this->once())
            ->method('flush');

        $response = $this->controller->deleteAction();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('categoria', $response->getHeaders()->get('Location')->getFieldValue());
    }
}