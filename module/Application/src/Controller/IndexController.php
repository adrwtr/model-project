<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;
use Application\Controller\BaseServiceManagerController;
use Doctrine\ORM\Query\ResultSetMapping;
use \Application\Entity\Tabela;

class IndexController extends BaseServiceManagerController
{
	public function __construct($objSM)
    {
		parent::__construct($objSM);
	}

    public function indexAction()
    {
        return new ViewModel();
    }

    public function listaTabelasAction()
    {
        $arrValores = $this->getEntityManager()
            ->createQuery('select t from \Application\Entity\Tabela t')
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return new JsonModel(
            $arrValores
        );
    }

    public function updateTabelasAction()
    {
        $ds_json_post = $this->getRequest()
            ->getContent();

        $objJson = json_decode($ds_json_post);

        $cd_tabela_id = $objJson->cd_tabela_id;
        $ds_tabela = $objJson->ds_tabela;

        $objTabela = new Tabela();

        // é alteracao
        if ($cd_tabela_id > 0) {
            $objTabela = $this->getEntityManager()
                ->getRepository(\Application\Entity\Tabela::class)
                ->getById($cd_tabela_id);
        }

        $objTabela->setDs_nome($ds_tabela);

        $this->getEntityManager()
            ->persist($objTabela);

        $this->getEntityManager()
            ->flush();

        return new JsonModel(
            [
                'sn_sucesso' => true,
                'nr_id_cadastrado' => $objTabela->getId()
            ]
        );
    }

    public function lerSqlAction()
    {
    	var_dump($this->getObjSm()->get(\Application\Service\ComandosSqlService::class)->teste()); //->teste();
    	return new ViewModel();
    }
}
