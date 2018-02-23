<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;
use Application\Controller\BaseServiceManagerController;

class IndexController extends BaseServiceManagerController
{
	public function __construct($objSM) {
		parent::__construct($objSM);
	}

    public function indexAction()
    {
        $arrValores = $this->getEntityManager()
            ->find(\Application\Entity\Tabela::class, 1);
        var_dump($arrValores);

        return new ViewModel();
    }

    public function listaTabelasAction() {
        $result = new JsonModel(array(
        'some_parameter' => 'some value',
            'success'=>true,
        ));

        return $result;
    }

    public function lerSqlAction()
    {
    	var_dump($this->getObjSm()->get(\Application\Service\ComandosSqlService::class)->teste()); //->teste();
    	return new ViewModel();
    }
}
