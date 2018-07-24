<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\BaseServiceManagerController;



class FixtureController extends BaseServiceManagerController
{
    public function __construct($objSM) {
        parent::__construct($objSM);
    }

    public function indexAction()
    {
        $loader = new \Nelmio\Alice\Loader\NativeLoader();
        $objectSet = $loader->loadFile(__DIR__ . '\..\..\fixture\fixture-tabelas.yaml');
        $arrFixtures = $objectSet->getObjects();

        $this->processClear(
            $this->arrClear()
        );

        $this->processInclusaoFixtures(
            $arrFixtures
        );

        return new ViewModel();
    }

    // Limpa todas estas tabelas
    public function arrClear()
    {
        $arrTabelas = array(
            'Sistema',
            'TipoDeChave',
            'Tabela',
            'Campo'
        );

        return $arrTabelas;
    }

    public function arrIncluirPadrao()
    {
        $arrTabelas = array(
            'Sistema',
            'TipoDeChave',
            'Tabela',
            'Campo'
        );

        return $arrTabelas;
    }

    public function processClear($arrTabelas)
    {
        foreach ($arrTabelas as $key => $value) {
            $objQuery = $this->getEntityManager()
                ->createQuery('delete from \\Application\\Entity\\' . $value);

            $objQuery->execute();
            unset($objQuery);
        }

        $this->getEntityManager()
            ->flush();
    }

    public function processInclusaoFixtures($arrFixtures)
    {
        foreach ($arrFixtures as $key => $value) {
            $this->getEntityManager()
                ->persist($value);
        }

        $this->getEntityManager()
            ->flush();
    }

    public function clearSistema()
    {
        $objQuery = $this->getEntityManager()
            ->createQuery('delete from \\Application\\Entity\\Sistema');

        $objQuery->execute();

        return $this;
    }

    public function clearTabela() {
        $objQuery = $this->getEntityManager()
            ->createQuery('delete from \\Application\\Entity\\Tabela');

        $objQuery->execute();

        return $this;
    }
}
