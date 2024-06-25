<?php

namespace Application\View\Helper;

use Zend\Authentication\AuthenticationService;
use Zend\View\Helper\AbstractHelper;

class LoggedUser extends AbstractHelper
{

    protected $authService;
    public function __construct(AuthenticationService$authService)
    {
        $this->authService = $authService;
    }

    public function __invoke()
    {
        if ($this->authService->hasIdentity()) {
            $identity = $this->authService->getIdentity();
            return $identity['nome'];
        }
        return 'Visitante';
    }

    

}
