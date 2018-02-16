<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
	private $objSM;

	private function getObjSm() {
		return $this->objSM;
	}

	public function __construct($objSM) {
		$this->objSM = $objSM;
	}

    public function indexAction()
    {
        return new ViewModel();
    }

    public function lerSqlAction()
    {
    	var_dump($this->getObjSm()->get(\Application\Service\ComandosSqlService::class)->teste()); //->teste();
    	return new ViewModel();
    }
}
