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
            ->createQuery(
                $this->getObjSm()
                    ->get(\Application\Service\Dql\TabelaDqlService::class)
                    ->listaTabelas()
            )
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return new JsonModel(
            $arrValores
        );
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

        return new JsonModel(
            [
                'arrTabela' => $arrTabela,
                'arrCampos' => $arrCampos
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

            if (count($arrCampos) > 0) {
                $this->updateCampos(
                    $objTabela,
                    $arrCampos
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
            ->listaTabelasTemporarias();

        $objStmt = $conn->prepare($ds_sql);
        $objStmt->execute();
        $arrValores = $objStmt->fetch();

        return new JsonModel(
            [
                'sn_sucesso' => true,
                'arrComparacao' => $arrValores
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


    private function updateCampos(
        $objTabela,
        $arrCampos
    ) {
	    /*
        if (is_array($arrCampos)) {
            foreach ($arrCampos as $nr_id => $arrCampo) {
                var_dump($nr_id);
                $nr_campo_id = $arrCampo->id ?? 0;
                $ds_nome = $arrCampo->ds_nome ?? '';
                $ds_prop = $arrCampo->ds_prop ?? '';
                $sn_pk = (($arrCampo->sn_pk ?? false) == '1' ? true : false);
                $ds_descricao = $arrCampo->ds_descricao ?? '';
                $nr_ordem = $nr_id ?? ;
                var_dump($nr_ordem);

                $objCampo = $this->getObjSm()
                    ->get(
                        \Application\Service\Repository\CampoService::class
                    )->persistir(
                        $objTabela,
                        $ds_nome,
                        $ds_prop,
                        $ds_descricao,
                        $sn_pk,
                        $nr_ordem,
                        $nr_campo_id
                    );

                $objTabela->addCampo($objCampo);
            }

            $this->getEntityManager()
                ->persist($objTabela);

            $this->getEntityManager()
                ->flush();
        }
	    */
    }
}
