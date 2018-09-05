<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;
use Application\Controller\BaseServiceManagerController;
use \Application\Entity\Tabela;
use \Application\Entity\Campo;
use \Application\Entity\TipoDeChave;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class TesteController extends BaseServiceManagerController
{
	public function __construct($objSM)
    {
		parent::__construct($objSM);
	}

    public function indexAction()
    {
        $objSistema = $this->getEntityManager()
            ->getRepository(\Application\Entity\Sistema::class)
            ->findOneBy([
                'id' => 2
            ]);

        // tabela de referencia
        $objTabelaReferencia = $this->getEntityManager()
            ->getRepository(\Application\Entity\Tabela::class)
            ->findOneBy([
                'ds_nome' => 'nu_integracao_externa',
                'objSistema' => $objSistema
            ]);

        dump($objTabelaReferencia);
        die();

        return new ViewModel();
    }
}
