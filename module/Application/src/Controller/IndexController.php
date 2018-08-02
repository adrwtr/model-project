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

    public function indexTabelaAction()
    {
        return new ViewModel(
            []
        );
    }

    public function listaTabelasAction()
    {
        // seta na sessao
        $objContainer = new Container('projeto');
        $nr_sistema_id = $objContainer->nr_sistema_id;

        $arrValores = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\TabelaDqlService::class)
                    ->listaTabelas()
            )
            ->setParameter('nr_sistema_id', $nr_sistema_id)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return new JsonModel(
            $arrValores
        );
    }

    public function listaSistemasAction()
    {
        $arrValores = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\SistemaDqlService::class)
                    ->listaSistemas()
            )
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return new JsonModel(
            $arrValores
        );
    }

    public function sistemaAdminTabelaAction()
    {
        $nr_registro = $this->params()
            ->fromRoute('nr_registro');

        // seta na sessao
        $objContainer = new Container('projeto');
        $objContainer->nr_sistema_id = $nr_registro;

        return $this->redirect()->toRoute('index-tabela');
    }

    public function getTabelaAction()
    {
        $cd_registro = $this->params()
            ->fromRoute('cd_registro');

        $arrTabela = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\TabelaDqlService::class)
                    ->getTabelaById()
            )
            ->setParameter('id', $cd_registro)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $arrCampos = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\CampoDqlService::class)
                    ->getCamposFromTabela()
            )
            ->setParameter('tabela_id', $cd_registro)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $arrTabelaChaves = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\TabelaChaveDqlService::class)
                    ->getCamposChaveFromTabela()
            )
            ->setParameter('tabela_origem_id', $cd_registro)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $arrTipoDeChave = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\TipoDeChaveDqlService::class)
                    ->getTiposDeChave()
            )
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $arrTodasAsTabelas = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\TabelaDqlService::class)
                    ->listaTodasAsTabelas()
            )
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);


        return new JsonModel(
            [
                'arrTabela' => $arrTabela,
                'arrCampos' => $arrCampos,
                'arrTabelaChaves' => $arrTabelaChaves,
                'arrTipoDeChave' => $arrTipoDeChave,
                'arrTodasAsTabelas' => $arrTodasAsTabelas
            ]
        );
    }

    public function updateTabelasAction()
    {
        $ds_json_post = $this->getRequest()
            ->getContent();

        $objJson = json_decode($ds_json_post);

        $nr_tabela_id = $objJson->nr_tabela_id ?? 0;
        $ds_tabela = $objJson->ds_tabela ?? '';
        $ds_sql = $objJson->ds_sql ?? '';
        $ds_descricao = $objJson->ds_descricao ?? '';
        $arrCampos = $objJson->arrCampos ?? [];
        $arrCamposExcluido = $objJson->arrCamposExcluido ?? [];

        $arrTabelaChaves = $objJson->arrTabelaChaves ?? [];
        $arrTabelaChavesExcluido = $objJson->arrTabelaChavesExcluido ?? [];

        $objTabela = null;

        if ($ds_tabela != '') {
            $objTabela = $this->getObjSm()
                ->get(
                    \Application\Service\Repository\TabelaService::class
                )->persistir(
                    $ds_tabela,
                    $ds_descricao,
                    $nr_tabela_id
                );

            $objInserirPorArrayService = $this->getObjSm()
                ->get(\Application\Service\InserirPorArrayService::class);

            if (count($arrCamposExcluido) > 0) {
                $objInserirPorArrayService->excluirCampos(
                    $arrCamposExcluido
                );
            }

            if (count($arrCampos) > 0) {
                $objInserirPorArrayService->updateCampos(
                    $objTabela,
                    $arrCampos
                );
            }

            if (count($arrTabelaChavesExcluido) > 0) {
                $objInserirPorArrayService->excluirTabelaChave(
                    $arrTabelaChavesExcluido
                );
            }

            if (count($arrTabelaChaves) > 0) {
                $objInserirPorArrayService->updateForeingkeys(
                    $objTabela,
                    $arrTabelaChaves
                );
            }
        }

        // importar por sql
        if ($ds_sql != '') {
            $objTabela = $this->processSql($ds_sql);
        }

        // verifica se foi incluido algum temporario
        $sn_tem_temporario = $this->getTemTemporario();

        return new JsonModel(
            [
                'sn_sucesso' => true,
                'sn_tem_temporario' => $sn_tem_temporario,
                'nr_tabela_id_cadastrado' => $objTabela->getId()
            ]
        );
    }

    public function deleteTabelaAction()
    {
        $cd_registro = $this->params()
            ->fromRoute('cd_registro');

        $this->getObjSm()
            ->get(
                \Application\Service\Repository\TabelaService::class
            )->desativarTabela(
                $cd_registro
            );

        return new JsonModel(
            [
                'sn_sucesso' => true,
                'nr_tabela_id_cadastrado' => $objTabela->getId()
            ]
        );
    }

    public function lerSqlAction()
    {
        $objComandosSqlService = $this->getObjSm()
            ->get(\Application\Service\ComandosSqlService::class);

        $objComandosSqlService->parse($ds_sql);

        $arrTabelas = $objComandosSqlService->getArrTabelas();

    	return new ViewModel();
    }

    public function listaTabelasTemporariasAction()
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        $ds_sql = $this->getObjSm()
            ->get(\Application\Service\Dql\TabelaDqlService::class)
            ->nativeListaTabelasTemporarias();

        $objStmt = $conn->prepare($ds_sql);
        $objStmt->execute();
        $arrValores = $objStmt->fetch();

        $nr_tabela_1_id = $arrValores['id'];
        $nr_tabela_2_id = $arrValores['id_temp'];

        // TODO: converter as buscas abaixo para uma função

        $arrCampos1 = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\CampoDqlService::class)
                    ->getCamposFromTabela()
            )
            ->setParameter('tabela_id', $nr_tabela_1_id)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $arrCampos2 = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\CampoDqlService::class)
                    ->getCamposFromTabela()
            )
            ->setParameter('tabela_id', $nr_tabela_2_id)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        // TODO: converter essa logica abaixo para uma função separada

        $arrCamposIguais = [];
        $arrSemIgualdadeA = [];
        $arrSemIgualdadeB = [];

        foreach ($arrCampos2 as $nr_campo_id => $arrCampo2) {
            $arrCampos2[$nr_campo_id]['sn_correspondente'] = false;
        }

        foreach ($arrCampos1 as $nr_campo_id => $arrCampo1) {
            $arrCampos1[$nr_campo_id]['sn_correspondente'] = false;

            foreach ($arrCampos2 as $nr_campo_id2 => $arrCampo2) {
                // encontrou correspondente
                if ($arrCampo1['ds_nome'] == $arrCampo2['ds_nome']) {
                    $arrCampos1[$nr_campo_id]['sn_correspondente'] = true;
                    $arrCampos2[$nr_campo_id2]['sn_correspondente'] = true;

                    $arrCamposIguais[] = array(
                        'arrCampo1' => $arrCampo1,
                        'arrCampo2' => $arrCampo2
                    );
                }
            }
        }

        // TODO: converter estas chamadas para um lambda

        foreach ($arrCampos1 as $nr_campo_id => $arrCampo1) {
            if ($arrCampo1['sn_correspondente'] == false) {
                $arrSemIgualdadeA[] = $arrCampo1;
            }
        }

        foreach ($arrCampos2 as $nr_campo_id => $arrCampo2) {
            if ($arrCampo2['sn_correspondente'] == false) {
                $arrSemIgualdadeB[] = $arrCampo2;
            }
        }

        return new JsonModel(
            [
                'sn_sucesso' => true,
                'arrComparacao' => $arrValores,
                'arrCamposIguais' => $arrCamposIguais,
                'arrSemIgualdadeA' => $arrSemIgualdadeA,
                'arrSemIgualdadeB' => $arrSemIgualdadeB,
            ]
        );
    }

    public function detalhesTabelaAction() {
        $nr_tabela_id = $this->params()
            ->fromRoute('nr_tabela_id');

        return new ViewModel(
            [
                'nr_tabela_id' => $nr_tabela_id
            ]
        );
    }

    public function getTabelaCamposAction() {
        $cd_registro = $this->params()
            ->fromRoute('cd_registro');

        $arrCampos = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\CampoDqlService::class)
                    ->getCamposFromTabela()
            )
            ->setParameter('tabela_id', $cd_registro)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return new JsonModel(
            [
                'arrCampos' => $arrCampos
            ]
        );
    }



    private function processSql($ds_sql)
    {
        $objComandosSqlService = $this->getObjSm()
            ->get(\Application\Service\ComandosSqlService::class);

        $objComandosSqlService->parse($ds_sql);

        $arrTabelas = $objComandosSqlService->getArrTabelas();
        $objTabela = null;

        // para cada tabela encontrada no sql
        if ($objComandosSqlService->getTotalTabelas() > 0) {
            $objInserirPorArrayService = $this->getObjSm()
                ->get(\Application\Service\InserirPorArrayService::class);

            $objTabela = $objInserirPorArrayService->inserirTabelas(
                $arrTabelas
            );
        }

        return $objTabela;
    }

    private function getTemTemporario()
    {
        $objTabela = $this->getEntityManager()
            ->getRepository(\Application\Entity\Tabela::class)
            ->findOneBy([
                'sn_temporario' => true
            ]);

        if ($objTabela != null) {
            return true;
        }

        return false;
    }
}
