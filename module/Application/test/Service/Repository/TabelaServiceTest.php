<?php
namespace ApplicationTest\Service;

use PHPUnit\Framework\TestCase;
use ApplicationTest\Service\Repository\AbstractZendServiceTestCase;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;


class TabelaServiceTest extends AbstractZendServiceTestCase
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
        $objSistema = $this->getObjSm()
            ->getRepository(
                \Application\Entity\Sistema::class
            )->findOneBy([
                'id' => 1
            ]);

        $this->assertQtdRegistro(
            \Application\Entity\Tabela::class,
            0
        );

        $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\TabelaService::class)
            ->persistir(
                $objSistema,
                'teste 1',
                'teste 1',
                'teste 1',
                null
            );

        $this->assertQtdRegistro(
            \Application\Entity\Tabela::class,
            1
        );

        $objTabela = $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\TabelaService::class)
            ->persistir(
                $objSistema,
                'teste 2',
                'teste 2',
                'teste 2',
                null
            );

        $this->assertQtdRegistro(
            \Application\Entity\Tabela::class,
            2
        );

        // update
        $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\TabelaService::class)
            ->persistir(
                $objSistema,
                'teste 2',
                'teste 2 2',
                'teste 2 2',
                $objTabela->getId()
            );

        $this->assertQtdRegistro(
            \Application\Entity\Tabela::class,
            2
        );
    }

    public function testeDesativarTabela()
    {
        $objSistema = $this->getObjSm()
            ->getRepository(
                \Application\Entity\Sistema::class
            )->findOneBy([
                'id' => 1
            ]);

        $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\TabelaService::class)
            ->persistir(
                $objSistema,
                'teste 1',
                'teste 1',
                'teste 1',
                null
            );

        $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\TabelaService::class)
            ->desativarTabela(1);

        $objTabela = $this->getObjSm()
            ->getRepository(\Application\Entity\Tabela::class)
            ->findOneBy([
                'id' => 1
            ]);

        $this->assertEquals(
            1,
            $objTabela->getSnExcluido()
        );
    }
}