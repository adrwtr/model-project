<?php
namespace ApplicationTest\Service;

use PHPUnit\Framework\TestCase;
use ApplicationTest\Service\Repository\AbstractZendServiceTestCase;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;


class TipoDeChaveServiceTest extends AbstractZendServiceTestCase
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
            \Application\Entity\TipoDeChave::class,
            0
        );

        $objTipoDeChave = $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\TipoDeChaveService::class)
            ->getTipoDeChaveForingKey();

        $this->assertQtdRegistro(
            \Application\Entity\TipoDeChave::class,
            1
        );

        $objTipoDeChave = $this->getApplicationServiceLocator()
            ->get(\Application\Service\Repository\TipoDeChaveService::class)
            ->getTipoDeChaveForingKey();

        $this->assertQtdRegistro(
            \Application\Entity\TipoDeChave::class,
            1
        );
    }
}