<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class BaseServiceManagerController extends AbstractActionController
{
    private $objSM;

    public function __construct($objSM) {
        $this->objSM = $objSM;
    }

    public function getObjSm() {
        return $this->objSM;
    }

    public function getEntityManager() {
        return $this->getObjSm()
            ->get('doctrine.entitymanager.orm_default');
    }
}