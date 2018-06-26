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

        if (!file_exists('sql_branco.sqlite')) {
            die('Erro: o arquivo do banco nao existe - sql_branco.sqlite');
        }

        if (!file_exists('sql_unittest.sqlite')) {
            die('Erro: o arquivo do banco nao existe - sql_unittest.sqlite');
        }

        copy('sql_branco.sqlite', 'sql_unittest.sqlite');

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
            $nr_qtd_registros,
            count($arrRegistros)
        );
    }

    /**
     * Ao finalizar
     */
    public function tearDown()
    {
        /*
        echo 'aqui A';
        if (file_exists('sql_unittest.sqlite')) {
            echo 'aqui B';
            $valor = unlink('sql_unittest.sqlite');
            var_dump($valor);
            echo "\n\n";
            echo $valor;
            copy('sql_backup.sqlite', 'sql_unittest.sqlite');
        }
        */
    }
}
