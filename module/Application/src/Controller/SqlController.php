<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;
use Zend\Session\Container;
use Application\Controller\BaseServiceManagerController;

use \Application\Entity\Tabela;
use \Application\Entity\Campo;
use \Application\Entity\TipoDeChave;


use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class SqlController extends BaseServiceManagerController
{
	public function __construct($objSM)
    {
		parent::__construct($objSM);
	}

    public function sqlAction()
    {

        return new ViewModel(
            array(

            )
        );
    }
}