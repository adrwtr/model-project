<?php
namespace ApplicationTest\Service;

use PHPUnit\Framework\TestCase;
use Application\Service\ComandosSqlService;
use PHPSQLParser\PHPSQLParser;


class ComandosSqlServiceTest  extends TestCase
{
	public function testParse()
	{
        $ds_sql = "CREATE TABLE CUSTOMERS(
            ID   INT              NOT NULL,
            NAME VARCHAR (20)     NOT NULL,
            AGE  INT              NOT NULL,
            ADDRESS  CHAR (25) ,
            SALARY   DECIMAL (18, 2),
            PRIMARY KEY (ID)
        );";

        $objComandosSqlService = new ComandosSqlService(
            new PHPSQLParser()
        );

		$objComandosSqlService->parse($ds_sql);

		$this->assertEquals(
			2,
			$objComandosSqlService->getTotalComandos()
		);

        $arrTabelas = $objComandosSqlService->getArrTabelas();

        $this->assertEquals(
            1,
            count($arrTabelas)
        );

        $this->assertEquals(
            5,
            count($arrTabelas[0]['arrCampos'])
        );

        $this->assertEquals(
            'ID',
            $arrTabelas[0]['arrCampos'][0]['ds_nome']
        );

        $this->assertEquals(
            'INT              NOT NULL',
            $arrTabelas[0]['arrCampos'][0]['ds_prop']
        );

        $this->assertEquals(
            true,
            $arrTabelas[0]['arrCampos'][0]['sn_pk']
        );
    }
}
