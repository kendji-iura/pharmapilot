<?php

namespace Application;
use Zend\Mvc\MvcEvent;
use Application\Controller\AuthController;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    const VERSION = '3.1.4dev';

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $container = $e->getApplication()->getServiceManager();

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, 
        function(MvcEvent $e) use ($container)
        {
            $match = $e->getRouteMatch();
            $authService = $container->get(AuthenticationServiceInterface::class);
            $routeName = $match->getMatchedRouteName();

            if ($authService->hasIdentity()){
                return;
            } elseif (strpos($routeName, 'admin') !== false) {
                $match->setParam('controller', AuthController::class)
                    ->setParam('action', 'login');
            }
        }, 100);

    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

}
