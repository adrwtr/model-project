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

// functional
use function Functional\select;
use function Functional\map;

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

    // retorna todas as conexoes
    public function listaConexaoAction()
    {
        $arrValores = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\ConexaoDqlService::class)
                    ->getAllConexao()
            )
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return new JsonModel(
            $arrValores
        );
    }

    // retorna todas as informacoes necessarias
    // para a realizacao de sqls e afins
    public function listaAllCamposAction()
    {
        $arrTabelas = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\TabelaDqlService::class)
                    ->getAllTabelas()
            )
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $arrCampos = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\CampoDqlService::class)
                    ->getAllCampos()
            )
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);


        $arrTabelaChaves = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\TabelaChaveDqlService::class)
                    ->getAllTabelaChave()
            )
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);


        // se a tabela_id for encontrada no array (no indice correto)
        $fnMapTabelasExistentes = function ($tabela_id, $ds_indice) {
            return function($arrValores, $nr_key, $arrColection) use ($tabela_id, $ds_indice) {
                return ($arrValores[$ds_indice] == $tabela_id);
            };
        };

        $fnMapTabelas = function($arrTabela) use ($arrCampos, $arrTabelaChaves, $fnMapTabelasExistentes) {
            $arrCamposSelecionados = select(
                $arrCampos,
                $fnMapTabelasExistentes(
                    $arrTabela['id'],
                    'tabela_id'
                )
            );

            $arrTabelaChaveSelecionada = select(
                $arrTabelaChaves,
                $fnMapTabelasExistentes(
                    $arrTabela['id'],
                    'tabela_origem_id'
                )
            );

            $arrTabela['arrCampos'] = $arrCamposSelecionados;
            $arrTabela['arrTabelaChavesOrigem'] = $arrTabelaChaveSelecionada;

            return $arrTabela;
        };

        $arrTabelas = map($arrTabelas, $fnMapTabelas);

        return new JsonModel(
            $arrTabelas
        );
    }


    public function executaAction()
    {
        $ds_json_post = $this->getRequest()
            ->getContent();

        $objJson = json_decode($ds_json_post);


        $arrResultado = $this->getObjSm()
            ->get(\Application\Service\Mysql\MysqlService::class)
            ->novaConexao(
                $objJson->conexao_atual->ds_host,
                $objJson->conexao_atual->ds_login,
                $objJson->conexao_atual->ds_pass,
                'unimestre'
            )
            ->executa('select cd_pessoa, nm_pessoa from pessoas limit 10');

        $this->getObjSm()
            ->get(\Application\Service\Mysql\MysqlService::class)
            ->fecharConexao();

        return new JsonModel(
            $arrResultado
        );
    }
}
