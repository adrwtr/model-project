<?php
namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ControllerComServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // $service = (null === $options) ? new $requestedName : new $requestedName($options);
        return new $requestedName($container);
    }
}