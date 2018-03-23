<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;
use Application\Controller\BaseServiceManagerController;
use \Application\Entity\Tabela;

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

        $arrValores = $this->getEntityManager()
            ->createQuery('select t from \Application\Entity\Tabela t where t.id = :id')
            ->setParameter('id', $cd_registro)
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

        $nr_id = $objJson->nr_id;
        $ds_tabela = $objJson->ds_tabela;
        $ds_sql = $objJson->ds_sql;
        $ds_descricao = $objJson->ds_descricao;

        $objTabela = null;

        if ($ds_tabela != '') {
            $objTabela = $this->updateTabela(
                $ds_tabela,
                $ds_descricao,
                $nr_id
            );
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
                'nr_id_cadastrado' => $objTabela->getId()
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
                'nr_id_cadastrado' => $objTabela->getId()
            ]
        );
    }

    public function lerSqlAction()
    {
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

    private function updateTabela(
        $ds_tabela,
        $ds_descricao = '',
        $nr_id = null
    ) {
        $objTabela = new Tabela();

        // é alteracao
        if ($nr_id > 0) {
            $objTabela = $this->getEntityManager()
                ->getRepository(\Application\Entity\Tabela::class)
                ->findOneBy([
                    'id' => $nr_id
                ]);
        }

        $objTabela->setDsNome($ds_tabela);
        $objTabela->setSnExcluido(false);
        $objTabela->setSnTemporario(false);
        $objTabela->setDsDescricao($ds_descricao);

        // é uma nova? verifica por duplicadas
        if ($nr_id == null) {
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
                // inclui a tabela
                $objTabela = $this->updateTabela($ds_nome, null);
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
}
