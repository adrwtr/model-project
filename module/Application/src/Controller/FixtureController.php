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

        $this->clearTabela();

        $this->getEntityManager()
            ->persist($arrFixtures['tabela1']);

        $this->getEntityManager()
            ->flush();

        return new ViewModel();
    }

    public function clearTabela() {
        $objQuery = $this->getEntityManager()
            ->createQuery('delete from \\Application\\Entity\\Tabela as t');

        $objQuery->execute();

        return $this;
    }
}
