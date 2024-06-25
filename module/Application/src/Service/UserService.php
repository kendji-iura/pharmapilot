<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Zend\Authentication\AuthenticationService;

class UserService
{

    private $authService;

    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke()
    {
        $identity = $this->authService->getIdentity();
        return $identity ? $identity->getNome() : 'Visitante';
    }


}
