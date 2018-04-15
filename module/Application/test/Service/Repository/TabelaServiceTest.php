<?php
namespace ApplicationTest\Service;

use PHPUnit\Framework\TestCase;
use Application\Service\ComandosSqlService;
use PHPSQLParser\PHPSQLParser;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;


class TabelaServiceTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $configOverrides = [];

        if (!file_exists('sql.sqlite')) {
            die('Erro: o arquivo do banco nao existe');
        }

        // faz backup do banco oficial
        copy('sql.sqlite', 'sql_backup.sqlite');
        unlink('sql.sqlite');
        copy('sql_unittest.sqlite', 'sql.sqlite');

        $this->setApplicationConfig(
            ArrayUtils::merge(
                include __DIR__ . '/../../../../../config/application.config.php',
                $configOverrides
            )
        );

        parent::setUp();
    }

    private function getObjSm()
    {
        return $this->getApplicationServiceLocator()
             ->get('doctrine.entitymanager.orm_default');
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

        $this->assertEquals(
            true,
            true
        );
    }

    private function assertQtdRegistro(
        $ds_entidade,
        $nr_qtd_registros
    ) {
        $arrRegistros = $this->getObjSm()
            ->getRepository(
                $ds_entidade
            )->findAll();

        $this->assertTrue(
            count($arrRegistros) == $nr_qtd_registros
        );
    }

    public function tearDown()
    {
        if (!file_exists('sql.sqlite')) {
            unlink('sql.sqlite');
            copy('sql_backup.sqlite', 'sql.sqlite');
        }
    }
}
