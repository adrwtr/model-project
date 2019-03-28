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

class RelatorioController extends BaseServiceManagerController
{
	public function __construct($objSM)
    {
		parent::__construct($objSM);
	}

    public function relatorioSistemaAction()
    {
        $arrValores = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\RelatorioDqlService::class)
                    ->getRelatorio()
            )
            // ->setParameter('nr_sistema_id', $nr_sistema_id)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $arrTabela = array();
        $arrCampo = array();

        foreach ($arrValores as $nr_key => $arrCampo) {
            $ds_prop = $this->parseProp($arrCampo['ds_prop']);
            $ds_prop .= ($arrCampo['sn_pk'] == true ? '[primary key]' : '');

            $arrCampo = array(
                'ds_nome' => $arrCampo['ds_nome'],
                'ds_prop' => $ds_prop
            );

            $arrTabela[$arrCampo['nr_tabela_id']]['arrCampo'][] = $arrCampo;
        }

        var_dump($arrValores);
        var_dump($arrTabela);

die();


        return new ViewModel();
    }

    public function parseProp($ds_prop) {
        if (substr($ds_prop, 0, 3) == 'int') {
            return 'int';
        }

        return 'varchar';
    }
}
