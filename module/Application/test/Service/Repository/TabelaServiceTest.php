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
        $this->assertQtdRegistro(
            \Application\Entity\Tabela::class,
            0
        );

        $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\TabelaService::class)
            ->persistir(
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
                'teste 2',
                'teste 2 2',
                $objTabela->getId()
            );

        $this->assertQtdRegistro(
            \Application\Entity\Tabela::class,
            2
        );
    }
}