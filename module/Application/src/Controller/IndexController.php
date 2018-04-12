<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;
use Application\Controller\BaseServiceManagerController;
use \Application\Entity\Tabela;
use \Application\Entity\Campo;

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
        $ds_dql = 'select t from \Application\Entity\Tabela t'
            . ' where t.sn_excluido = 0 and t.sn_temporario = 0';

        $arrValores = $this->getEntityManager()
            ->createQuery($ds_dql)
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
            ->createQuery('select t from \Application\Entity\Tabela t where t.id = :id')
            ->setParameter('id', $cd_registro)
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $arrCampos = $this->getEntityManager()
            ->createQuery('select c from \Application\Entity\Campo c
                where c.objTabela = :tabela_id
                order by c.nr_ordem'
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
            $objTabela = $this->updateTabela(
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

        var_dump($arrTabelas);

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

    private function updateTabela(
        $ds_tabela,
        $ds_descricao = '',
        $nr_tabela_id = null
    ) {
        $objTabela = new Tabela();

        // é alteracao
        if ($nr_tabela_id > 0) {
            $objTabela = $this->getEntityManager()
                ->getRepository(\Application\Entity\Tabela::class)
                ->findOneBy([
                    'id' => $nr_tabela_id
                ]);
        }

        $objTabela->setDsNome($ds_tabela);
        $objTabela->setSnExcluido(false);
        $objTabela->setSnTemporario(false);
        $objTabela->setDsDescricao($ds_descricao);

        // é uma nova? verifica por duplicadas
        if ($nr_tabela_id == null) {
            $objTabelaDuplicada = $this->getEntityManager()
                ->getRepository(\Application\Entity\Tabela::class)
                ->findOneBy([
                    'ds_nome' => $ds_tabela
                ]);

            // se ela ja existir, indica que é duplicada
            if ($objTabelaDuplicada != null) {
                $objTabela->setSnTemporario(true);
            }
        }

        $this->getEntityManager()
            ->persist($objTabela);

        $this->getEntityManager()
            ->flush();

        return $objTabela;
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
                $objTabela = $this->updateTabela($ds_nome, null);

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
                if (count($arrForeingkey) > 0) {
                    $arrForeingkeyObj = [];
                    foreach ($arrForeingkeys as $arrForeingkey) {
                        $ds_nome_campo = $arrCampo['ds_nome_campo'];
                        $ds_nome_tabela_referencia = $arrCampo['ds_nome_tabela_referencia'];
                        $ds_nome_campo_referencia = $arrCampo['ds_nome_campo_referencia'];

                        $objForeingkey = new \stdClass();
                        $objForeingkey->id = null;
                        $objForeingkey->ds_nome_campo = $ds_nome_campo;
                        $objForeingkey->ds_nome_tabela_referencia = $ds_nome_tabela_referencia;
                        $objForeingkey->ds_nome_campo_referencia = $ds_nome_campo_referencia;

                        $arrForeingkeyObj[] = $objCampo;
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

                $objCampo = new Campo();

                // o campo ja existe
                if ($nr_campo_id > 0) {
                    $objCampo = $this->getEntityManager()
                        ->getRepository(\Application\Entity\Campo::class)
                        ->findOneBy([
                            'id' => $nr_campo_id
                        ]);
                }

                $objCampo->setDsNome($ds_nome);
                $objCampo->setDsProp($ds_prop);
                $objCampo->setObjTabela($objTabela);
                $objCampo->setSnPk($sn_pk);
                $objCampo->setNrOrdem($nr_id);
                $objCampo->setDsDescricao($ds_descricao);

                $this->getEntityManager()
                    ->persist($objCampo);
            }

            $this->getEntityManager()
                ->flush();
        }
    }

    private function updateForeingkeys(
        $objTabela,
        $arrForeingkeys
    ) {
        if (is_array($arrForeingkeys)) {
            $arrCamposTabela = $objTabela->arrCampos;



            foreach ($arrForeingkeys as $nr_id => $arrForeingkey) {
                $nr_campo_id = $objForeingkey->id ?? 0;
                $ds_nome_campo = $objForeingkey->ds_nome_campo ?? '';
                $ds_nome_tabela_referencia = $objForeingkey->ds_nome_tabela_referencia ?? '';
                $ds_nome_campo_referencia = $objForeingkey->ds_nome_campo_referencia ?? '';

                if ($ds_nome_campo != '' && $ds_nome_campo_referencia != '') {
                    $objTabelaChave = new TabelaChave();

                    // o campo ja existe
                    if ($nr_campo_id > 0) {
                        $objCampo = $this->getEntityManager()
                            ->getRepository(\Application\Entity\Campo::class)
                            ->findOneBy([
                                'id' => $nr_campo_id
                            ]);
                    }

                    $objCampo->setDsNome($ds_nome);
                    $objCampo->setDsProp($ds_prop);
                    $objCampo->setObjTabela($objTabela);
                    $objCampo->setSnPk($sn_pk);
                    $objCampo->setNrOrdem($nr_id);
                    $objCampo->setDsDescricao($ds_descricao);

                    $this->getEntityManager()
                        ->persist($objCampo);
                }
            }

            $this->getEntityManager()
                ->flush();
        }
    }
}
