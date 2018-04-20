<?php
namespace ApplicationTest\Service;

use PHPUnit\Framework\TestCase;
use ApplicationTest\Service\Repository\AbstractZendServiceTestCase;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;


class CampoServiceTest extends AbstractZendServiceTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testePersistir()
    {
        $this->assertQtdRegistro(
            \Application\Entity\Campo::class,
            0
        );

        $objTabela = $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\TabelaService::class)
            ->persistir(
                'teste 1',
                'teste 1',
                null
            );

        $objCampo = $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\CampoService::class)
            ->persistir(
                $objTabela,
                'ds_nome',
                'ds_prop',
                'ds_descricao',
                0,
                0,
                null
            );

        $this->assertQtdRegistro(
            \Application\Entity\Campo::class,
            1
        );


        // outro insert
        $objCampo2 = $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\CampoService::class)
            ->persistir(
                $objTabela,
                'ds_nome 2',
                'ds_prop 2',
                'ds_descricao 2',
                1,
                1,
                null
            );

        $this->assertQtdRegistro(
            \Application\Entity\Campo::class,
            2
        );


        // update
        // outro insert
        $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\CampoService::class)
            ->persistir(
                $objTabela,
                'ds_nome 3',
                'ds_prop 3',
                'ds_descricao 3',
                1,
                1,
                $objCampo->getId()
            );

        $this->assertQtdRegistro(
            \Application\Entity\Campo::class,
            2
        );

    }
}