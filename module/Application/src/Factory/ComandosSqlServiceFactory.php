<?php
namespace Application\Factory;

use Application\Service;

use PHPSQLParser\PHPSQLParser;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\ServiceLocatorInterface;

class ComandosSqlServiceFactory implements FactoryInterface {
    public function __invoke(
    	\Interop\Container\ContainerInterface $container,
    	$requestedName,
    	array $options = null
    ){
    	return new \Application\Service\ComandosSqlService(
            new PHPSQLParser()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator) {
    	// return new ComandosSqlService();
    }
}