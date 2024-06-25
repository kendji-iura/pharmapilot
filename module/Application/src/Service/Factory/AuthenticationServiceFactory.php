<?php

namespace Application\Service\Factory;

use Zend\Db\Sql\Select;
use Application\Model\Usuario;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Authentication\Storage\Session;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;

class AuthenticationServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        // $passwordCallbackVerify = function ($passwordInDatabase, $passwordSent) {

        //     return password_verify($passwordSent, $passwordInDatabase);
        // };
        // $dbAdapter = $container->get(AdapterInterface::class);
        // $authAdapter = new CallbackCheckAdapter($dbAdapter, 'usuarios', 'email', 'senha', $passwordCallbackVerify);
        // $select = $authAdapter->getDbSelect();
        // $select->where('ativo = 1');
        // $storage = new Session();
        // $authServ = new AuthenticationService($storage, $authAdapter);
        // $tabela = $container->get(UsuarioTable::class);
        // $_SESSION['usuario'] = $tabela->getByEmail($_SESSION['Zend_Auth']['storage']);

        // return $authServ;
        return $container->get('doctrine.authenticationservice.orm_default');
    }
}
