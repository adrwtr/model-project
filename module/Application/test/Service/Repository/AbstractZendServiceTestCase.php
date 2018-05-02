<?php
namespace ApplicationTest\Service\Repository;

use PHPUnit\Framework\TestCase;
use Application\Service\ComandosSqlService;
use PHPSQLParser\PHPSQLParser;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;


abstract class AbstractZendServiceTestCase extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $configOverrides = [];

        if (!file_exists('sql.sqlite')) {
            die('Erro: o arquivo do banco nao existe - sql.sqlite');
        }

        if (!file_exists('sql_unittest.sqlite')) {
            die('Erro: o arquivo do banco nao existe - sql_unittest.sqlite');
        }

        // faz backup do banco oficial
        copy('sql.sqlite', 'sql_backup.sqlite');
        @unlink('sql.sqlite');

        if (file_exists('sql_unittest.sqlite')) {
            copy('sql_unittest.sqlite', 'sql.sqlite');
        }

        $this->setApplicationConfig(
            ArrayUtils::merge(
                include __DIR__ . '/../../../../../config/application.config.php',
                $configOverrides
            )
        );

        parent::setUp();
    }

    public function getObjSm()
    {
        return $this->getApplicationServiceLocator()
             ->get('doctrine.entitymanager.orm_default');
    }

    public function assertQtdRegistro(
        $ds_entidade,
        $nr_qtd_registros
    ) {
        $arrRegistros = $this->getObjSm()
            ->getRepository(
                $ds_entidade
            )->findAll();

        $this->assertEquals(
            count($arrRegistros),
            $nr_qtd_registros
        );
    }

    /**
     * Ao finalizar
     */
    public function tearDown()
    {
        if (!file_exists('sql.sqlite')) {
            unlink('sql.sqlite');
            copy('sql_backup.sqlite', 'sql.sqlite');
        }
    }
}
