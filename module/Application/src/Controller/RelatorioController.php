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
                    ->getRelatorioTabelaCampo()
            )
            // ->setParameter('nr_sistema_id', $nr_sistema_id)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $arrTabela = array();
        $arrCampoAtual = array();

        foreach ($arrValores as $nr_key => $arrCampo) {
            $ds_prop = $this->parseProp($arrCampo['ds_prop']);
            $ds_prop .= ($arrCampo['sn_pk'] == true ? ' [primary key]' : '');

            $arrCampoAtual = array(
                'ds_nome' => $arrCampo['ds_nome'],
                'ds_prop' => $ds_prop
            );

            $arrTabela[$arrCampo['nr_tabela_id']]['arrCampo'][] = $arrCampoAtual;
            $arrTabela[$arrCampo['nr_tabela_id']]['ds_nome'] = $arrCampo['ds_tabela_nome'];
        }


        // construcao da string
        $ds_string_tudo = '';
        foreach ($arrTabela as $key => $arrTabela) {
            $ds_string_tudo .= 'Table '
                . $arrTabela['ds_nome']
                . ' {<br>';

            foreach ($arrTabela['arrCampo'] as $arrCampo) {
                $ds_string_tudo .= $arrCampo['ds_nome']
                    . ' '
                    . $arrCampo['ds_prop']
                    . '<br>';
            }

            $ds_string_tudo .= '}<br><br>';
        }

        $ds_string_tudo .= $this->getRelatorioFK();

        return new ViewModel(
            array(
                'ds_string_tudo' => $ds_string_tudo
            )
        );
    }

    public function parseProp($ds_prop) {
        if (substr($ds_prop, 0, 3) == 'int') {
            return 'int';
        }

        if (substr($ds_prop, 0, 6) == 'bigint') {
            return 'int';
        }

        return 'varchar';
    }

    public function getRelatorioFK()
    {
        $arrValores = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\RelatorioDqlService::class)
                    ->getRelatorioFK()
            )
            // ->setParameter('nr_sistema_id', $nr_sistema_id)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $ds_string_tudo = '';

        foreach ($arrValores as $arrFk) {
            $ds_string_tudo .= 'Ref: '
                . '"' . $arrFk['ds_nome_tabela_origem']  . '"'
                . '.'
                . '"' . $arrFk['ds_nome_campo_origem'] . '"'
                . ' < '
                . '"' . $arrFk['ds_nome_tabela_destino']  . '"'
                . '.'
                . '"' . $arrFk['ds_nome_campo_destino'] . '"'
                . '<BR>';
        }

        return $ds_string_tudo;
    }


    // 1 para vários
    // Ref: "mdl_enrol"."id" < "api_log_qb"."cd_log"
}
