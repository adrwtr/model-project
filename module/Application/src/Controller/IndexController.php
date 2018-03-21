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
        $ds_dql = 'select t from \Application\Entity\Tabela t'
            . ' where t.sn_excluido = 0';

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

        $objTabela = null;

        if ($ds_tabela != '') {
            $objTabela = $this->updateTabela(
                $ds_tabela,
                $nr_id
            );
        }

        if ($ds_sql != '') {
            $objTabela = $this->processSql($ds_sql);
        }

        return new JsonModel(
            [
                'sn_sucesso' => true,
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

    private function updateTabela(
        $ds_tabela,
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
}
