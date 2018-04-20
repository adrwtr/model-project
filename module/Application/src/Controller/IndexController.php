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

        $objTabela = $this->getEntityManager()
            ->getRepository(\Application\Entity\Tabela::class)
            ->findOneBy([
                'id' => $cd_registro
            ]);

        $objTabela->setSnExcluido(true);

        $this->getEntityManager()
            ->persist($objTabela);

        $this->getEntityManager()
            ->flush();

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

        $sql = '
            select
                t.id as id,
                t.ds_nome as ds_nome,
                t_temp.id as id_temp,
                t_temp.ds_nome as ds_nome_temp
            from Tabela t
            inner join Tabela t_temp ON (
                t_temp.ds_nome = t.ds_nome
                and t_temp.sn_temporario = 0
            )
            where
                t.sn_temporario = 1
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $arrValores = $stmt->fetch();

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
            foreach ($arrTabelas as $arrTabela) {
                $ds_nome = $arrTabela['ds_nome'];
                $arrCampos = $arrTabela['arrCampos'];
                $arrForeingkeys = $arrTabela['arrForeingkey'];

                // inclui a tabela
                $objTabela = $this->getObjSm()
                    ->get(
                        \Application\Service\Repository\TabelaService::class
                    )->persistir(
                        $ds_nome
                    );

                // inclui campos
                if (count($arrCampos) > 0) {
                    $arrCampoObj = [];
                    foreach ($arrCampos as $arrCampo) {
                        $ds_nome_campo = $arrCampo['ds_nome'];
                        $ds_prop = $arrCampo['ds_prop'];
                        $sn_pk = $arrCampo['sn_pk'];

                        $objCampo = new \stdClass();
                        $objCampo->id = null;
                        $objCampo->ds_nome = $ds_nome_campo;
                        $objCampo->ds_prop = $ds_prop;
                        $objCampo->sn_pk = $sn_pk;

                        $arrCampoObj[] = $objCampo;
                    }

                    $this->updateCampos($objTabela, $arrCampoObj);
                }

                // inclui foreingkeys
                if (count($arrForeingkeys) > 0) {
                    $arrForeingkeyObj = [];
                    foreach ($arrForeingkeys as $arrForeingkey) {
                        $ds_nome_campo = $arrForeingkey['ds_nome_campo'] ?? '';
                        $ds_nome_tabela_referencia = $arrForeingkey['ds_nome_tabela_referencia'] ?? '';
                        $ds_nome_campo_referencia = $arrForeingkey['ds_nome_campo_referencia'] ?? '';

                        $objForeingkey = new \stdClass();
                        $objForeingkey->id = null;
                        $objForeingkey->ds_nome_campo = $ds_nome_campo;
                        $objForeingkey->ds_nome_tabela_referencia = $ds_nome_tabela_referencia;
                        $objForeingkey->ds_nome_campo_referencia = $ds_nome_campo_referencia;

                        $arrForeingkeyObj[] = $objForeingkey;
                    }

                    $this->updateForeingkeys($objTabela, $arrForeingkeyObj);
                }
            }
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
        if (is_array($arrCampos)) {
            foreach ($arrCampos as $nr_id => $arrCampo) {
                $nr_campo_id = $arrCampo->id ?? 0;
                $ds_nome = $arrCampo->ds_nome ?? '';
                $ds_prop = $arrCampo->ds_prop ?? '';
                $sn_pk = (($arrCampo->sn_pk ?? false) == '1' ? true : false);
                $ds_descricao = $arrCampo->ds_descricao ?? '';

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
    }

    private function updateForeingkeys(
        $objTabela,
        $arrForeingkeys
    ) {
        if (is_array($arrForeingkeys)) {
            $arrCamposTabela = $objTabela->getArrCampos();

            foreach ($arrForeingkeys as $nr_id => $objForeingkey) {

                $nr_campo_id = $objForeingkey->id ?? 0;
                $ds_nome_campo = $objForeingkey->ds_nome_campo ?? '';
                $ds_nome_tabela_referencia = $objForeingkey->ds_nome_tabela_referencia ?? '';
                $ds_nome_campo_referencia = $objForeingkey->ds_nome_campo_referencia ?? '';

                if ($ds_nome_campo != '' && $ds_nome_campo_referencia != '') {
                    $nr_key_campo_atual = 0;
                    $nr_key_campo_referencia = 0;

                    // campo atual
                    if (count($arrCamposTabela) > 0) {
                        foreach ($arrCamposTabela as $nr_key => $objCampo) {
                            if ($objCampo->getDsNome() == $ds_nome_campo) {
                                $nr_key_campo_atual = $nr_key;
                            }
                        }

                        // tabela de referencia
                        $objTabelaReferencia = $this->getEntityManager()
                            ->getRepository(\Application\Entity\Tabela::class)
                            ->findOneBy([
                                'ds_nome' => $ds_nome_tabela_referencia
                            ]);

                        // a tabela nao existe, vamos criar ela
                        if ($objTabelaReferencia == null) {
                            $objTabelaReferencia = $this->getObjSm()
                                ->get(
                                    \Application\Service\Repository\TabelaService::class
                                )->persistir(
                                    $ds_nome_tabela_referencia
                                );

                        }

                        $arrCamposTabelaReferencia = $objTabelaReferencia->getArrCampos();

                        // campo referencia
                        if (count($arrCamposTabelaReferencia) > 0) {
                            foreach ($arrCamposTabelaReferencia as $nr_key => $objCampo) {
                                if ($objCampo->getDsNome() == $ds_nome_campo_referencia) {
                                    $nr_key_campo_referencia = $nr_key;
                                }
                            }
                        }

                        // buscando a chave
                        $objTipoDeChave = $this->getEntityManager()
                            ->getRepository(\Application\Entity\TipoDeChave::class)
                            ->findOneBy([
                                'ds_chave' => \Application\Entity\TipoDeChave::FOREING_KEY
                            ]);

                        if ($objTipoDeChave == null) {
                            $objTipoDeChave = new \Application\Entity\TipoDeChave();
                            $objTipoDeChave->setDsNome('Foreing Key')
                                ->setDsChave(
                                    \Application\Entity\TipoDeChave::FOREING_KEY
                                );

                            $this->getEntityManager()
                                ->persist($objTipoDeChave);

                            $this->getEntityManager()
                                ->flush();
                        }

                        // inclui a chave
                        $objTabelaChave = new \Application\Entity\TabelaChave();
                        $objTabelaChave->setObjTabelaOrigem($objTabela);
                        $objTabelaChave->setObjTabelaDestino($objTabelaReferencia);
                        $objTabelaChave->setObjCampoOrigem($arrCamposTabela[$nr_key_campo_atual]);
                        $objTabelaChave->setObjTipoDeChave($objTipoDeChave);

                        if (count($arrCamposTabelaReferencia) > 0) {

                            $objTabelaChave->setObjCampoDestino(
                                $arrCamposTabelaReferencia[$nr_key_campo_referencia]
                            );
                        }

                        $this->getEntityManager()
                            ->persist($objTabelaChave);

                        $this->getEntityManager()
                            ->flush();
                    }
                }
            }
        }
    }
}
