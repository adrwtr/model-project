<?php
namespace Application\Factory;

use Application\Service;


use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\ServiceLocatorInterface;

class RepositoryFactory implements FactoryInterface {
    public function __invoke(
    	\Interop\Container\ContainerInterface $container,
    	$requestedName,
    	array $options = null
    ){
    	return new $requestedName(
            $container->get('doctrine.entitymanager.orm_default')
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator) {
    	// return new ComandosSqlService();
    }
}