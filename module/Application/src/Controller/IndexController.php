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

            $a = $this->getEntityManager()
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\TabelaChaveDqlService::class)
                    ->getCamposChaveFromTabela()
            )
            ->setParameter('tabela_origem_id', $cd_registro);

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
        $objContainer = new Container('projeto');
        $nr_sistema_id = $objContainer->nr_sistema_id;

        $objSistema = $this->getObjSistema($nr_sistema_id);

        $ds_json_post = $this->getRequest()
            ->getContent();

        $objJson = json_decode($ds_json_post);

        $nr_tabela_id = $objJson->nr_tabela_id ?? 0;
        $ds_tabela = $objJson->ds_tabela ?? '';
        $ds_sql = $objJson->ds_sql ?? '';
        $ds_descricao = $objJson->ds_descricao ?? '';
        $ds_tag = $objJson->ds_tag ?? '';
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
                    $objSistema,
                    $ds_tabela,
                    $ds_descricao,
                    $ds_tag,
                    $nr_tabela_id
                );

            $objInserirPorArrayService = $this->getObjSm()
                ->get(\Application\Service\InserirPorArrayService::class);

            if (count($arrCamposExcluido) > 0) {
                $objInserirPorArrayService->excluirCampos(
                    $objTabela,
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
                    $objSistema,
                    $objTabela,
                    $arrTabelaChaves
                );
            }
        }

        // importar por sql
        if ($ds_sql != '') {
            $objTabela = $this->processSql(
                $objSistema,
                $ds_sql
            );
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
                'nr_tabela_id_excluido' => $cd_registro
            ]
        );
    }

    public function lerSqlAction()
    {
        $ds_sql = $objComandosSqlService = $this->getObjSm()
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

                    $arrCampos1[$nr_campo_id]['sn_selecionado'] = true;
                    $arrCampos2[$nr_campo_id2]['sn_selecionado'] = false;

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
                $arrCampo1['sn_selecionado'] = true;
                $arrSemIgualdadeA[] = $arrCampo1;
            }
        }

        foreach ($arrCampos2 as $nr_campo_id => $arrCampo2) {
            if ($arrCampo2['sn_correspondente'] == false) {
                $arrCampo2['sn_selecionado'] = true;
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


    public function mergeTabelasAction()
    {
        $ds_json_post = $this->getRequest()
            ->getContent();

        $objJson = json_decode($ds_json_post);

        $arrComparacao = $objJson->arrComparacao;
        $arrCamposIguais = $objJson->arrCamposIguais;
        $arrSemIgualdadeA = $objJson->arrSemIgualdadeA;
        $arrSemIgualdadeB = $objJson->arrSemIgualdadeB;

        // qual vamos manter e
        // qual vamos apagar?
        $nr_tabela_id_manter = $arrComparacao->id > $arrComparacao->id_temp
            ? $arrComparacao->id
            : $arrComparacao->id_temp;

        $nr_tabela_id_apagar = $arrComparacao->id > $arrComparacao->id_temp
            ? $arrComparacao->id_temp
            : $arrComparacao->id;

        $nr_tabela_id_1 = $arrComparacao->id;
        $nr_tabela_id_2 = $arrComparacao->id_temp;

        // campos da comparacao
        foreach ($arrCamposIguais as $arrCampos) {
            $sn_campo1_apagado = false;

            if (!isset($arrCampos->arrCampo1->sn_selecionado)) {
                $arrCampos->arrCampo1->sn_selecionado = false;
            }

            if ($arrCampos->arrCampo1->sn_selecionado == false) {
                $sn_campo1_apagado = true;

                // apagar campo 1 da tabela 1
                $objCampoApagar = $this->getEntityManager()
                    ->getRepository(\Application\Entity\Campo::class)
                    ->findOneBy([
                        'id' => $arrCampos->arrCampo1->id
                    ]);

                $this->getEntityManager()
                    ->remove($objCampoApagar);

                $this->getEntityManager()
                    ->flush();
            }

            if (!isset($arrCampos->arrCampo2->sn_selecionado)) {
                $arrCampos->arrCampo2->sn_selecionado = false;
            }

            if ($arrCampos->arrCampo2->sn_selecionado == false) {
                // apagar campo 2 da tabela 2
                // apagar campo 1 da tabela 1
                $objCampoApagar = $this->getEntityManager()
                    ->getRepository(\Application\Entity\Campo::class)
                    ->findOneBy([
                        'id' => $arrCampos->arrCampo2->id
                    ]);

                $this->getEntityManager()
                    ->remove($objCampoApagar);

                $this->getEntityManager()
                    ->flush();
            }

            if (!isset($arrCampos->arrCampo2->sn_selecionado)) {
                $arrCampos->arrCampo2->sn_selecionado = false;
            }

            if ($arrCampos->arrCampo2->sn_selecionado == true && $sn_campo1_apagado == true) {
                // atualiza o campo 2 para ser da tabela 1
                $objCampo2 = $this->getEntityManager()
                    ->getRepository(\Application\Entity\Campo::class)
                    ->findOneBy([
                        'id' => $arrCampos->arrCampo2->id
                    ]);

                $objTabela1 = $this->getEntityManager()
                    ->getRepository(\Application\Entity\Tabela::class)
                    ->findOneBy([
                        'id' => $nr_tabela_id_1
                    ]);

                $objCampo2->setObjTabela($objTabela1);

                $this->getEntityManager()
                    ->flush();
            }
        }


        foreach ($arrSemIgualdadeA as $arrCampo) {
            if ($arrCampo->sn_selecionado == false) {
                // apagar campo da tabela 1
                $objCampoApagar = $this->getEntityManager()
                    ->getRepository(\Application\Entity\Campo::class)
                    ->findOneBy([
                        'id' => $arrCampo->id
                    ]);

                $this->getEntityManager()
                    ->remove($objCampoApagar);
            }
        }

        foreach ($arrSemIgualdadeB as $arrCampo) {
            if ($arrCampo->sn_selecionado == false) {
                $objCampoApagar = $this->getEntityManager()
                    ->getRepository(\Application\Entity\Campo::class)
                    ->findOneBy([
                        'id' => $arrCampo->id
                    ]);

                $this->getEntityManager()
                    ->remove($objCampoApagar);
            }
        }

        // exclui a temporaria
        $objTabela2 = $this->getEntityManager()
            ->getRepository(\Application\Entity\Tabela::class)
            ->findOneBy([
                'id' => $nr_tabela_id_apagar
            ]);

        $this->getEntityManager()
            ->remove($objTabela2);

        // atualiza atual para nao ser temporaria
        $objTabela = $this->getEntityManager()
            ->getRepository(\Application\Entity\Tabela::class)
            ->findOneBy([
                'id' => $nr_tabela_id_manter
            ]);

        $objTabela->setSnTemporario(0);

        $this->getEntityManager()
                ->persist($objTabela);

        $this->getEntityManager()
            ->flush();

        return new JsonModel(
            [
                'sn_sucesso' => true
            ]
        );
    }

    public function testeAction()
    {

    }

    public function getTabelaRepetidaAction()
    {
        $conn = $this->getEntityManager()
            ->getConnection();

        $ds_sql = $this->getObjSm()
            ->get(\Application\Service\Dql\TabelaDqlService::class)
            ->nativeListaTabelasTemporarias();

        $objStmt = $conn->prepare($ds_sql);
        $objStmt->execute();
        $arrValores = $objStmt->fetch();

        $sn_tem_repetido = false;

        if ($arrValores != false) {
            $sn_tem_repetido = count($arrValores) >= 1;
        }

        return new JsonModel(
            [
                'sn_tem_repetido' => $sn_tem_repetido
            ]
        );
    }



    private function processSql(
        $objSistema,
        $ds_sql
    ) {
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
                $objSistema,
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

    private function getObjSistema($nr_sistema_id)
    {
        return $this->getEntityManager()
            ->getRepository(\Application\Entity\Sistema::class)
            ->findOneBy([
                'id' => $nr_sistema_id
            ]);
    }
}
