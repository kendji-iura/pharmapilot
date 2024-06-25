<?php

namespace Application\Service\Factory;

use Application\Service\UserService;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authenticationService = $container->get('doctrine.authenticationservice.orm_default');
        return new UserService($authenticationService);
    }
}
