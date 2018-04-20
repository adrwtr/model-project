<?php
namespace ApplicationTest\Service;

use PHPUnit\Framework\TestCase;
use Application\Service\ComandosSqlService;
use PHPSQLParser\PHPSQLParser;
use ApplicationTest\Service\Repository\AbstractZendServiceTestCase;


class InserirPorArrayServiceTest extends AbstractZendServiceTestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function tearDown() {
        parent::tearDown();
    }

	public function testParse()	{


        $objComandosSqlService = $this->getApplicationServiceLocator()
            ->get(\Application\Service\ComandosSqlService::class);

        $objComandosSqlService->parse(
            $this->getDsSql()
        );

        $arrTabelas = $objComandosSqlService->getArrTabelas();

        $this->getApplicationServiceLocator()
            ->get(\Application\Service\InserirPorArrayService::class)
            ->inserirTabelas($arrTabelas);

        $this->assertQtdRegistro(
            \Application\Entity\Tabela::class,
            1
        );

        $this->assertQtdRegistro(
            \Application\Entity\Campo::class,
            5
        );
    }

    private function getDsSql() {
        return 'CREATE TABLE CUSTOMERS(
            ID   INT              NOT NULL,
            NAME VARCHAR (20)     NOT NULL,
            AGE  INT              NOT NULL,
            ADDRESS  CHAR (25) ,
            SALARY   DECIMAL (18, 2),
            PRIMARY KEY (ID)';
    }
}
