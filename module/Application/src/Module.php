<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Session\SessionManager;
use Zend\Mvc\MvcEvent;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(
        MvcEvent $objMvcEvent
    ) {
        $application = $objMvcEvent->getApplication();
        $serviceManager = $application->getServiceManager();

        $manager = new SessionManager();
        \Zend\Session\Container::setDefaultManager($manager);
        // $serviceManager->get(SessionManager::class);
    }
}
