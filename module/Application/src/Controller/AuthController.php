<?php

namespace Application\Controller;

use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Mvc\Console\View\ViewModel;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Mvc\Controller\AbstractActionController;

class AuthController extends AbstractActionController
{
    private $authService;

    public function __construct(AuthenticationServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function loginAction()
    {
        if ($this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }
        $messageError = null;
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $authAdapter = $this->authService->getAdapter();
            $authAdapter->setIdentity($data['email']);
            $authAdapter->setCredential($data['senha']);
            //dd($data['senha']);

            $result = $this->authService->authenticate();

            if ($result->isValid()) {
                return $this->redirect()->toRoute('home');
            } else {
                $messageError[] = 'Login inválido.';
            }
        }
        $erros = null;
        if ($messageError != null) {
            $erros = generateErrorModal('Login Inválido', $messageError);
        }
        return new ViewModel([
            'erros' => $erros,
        ]);
    }

    public function logoutAction()
    {
        $this->authService->clearIdentity();
        return $this->redirect()->toRoute('login');
    }
}
