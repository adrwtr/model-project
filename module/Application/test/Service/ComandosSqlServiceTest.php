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

        $this->assertEquals(
            [],
            $arrTabelas[0]['arrForeingkey']
        );
    }




    public function testForeingKeyParse()
    {
        $ds_sql = "
        CREATE TABLE `nu_grupos_pessoas` (
          `cd_grupo_pessoa` int(11) NOT NULL AUTO_INCREMENT,
          `cd_grupo` int(11) NOT NULL DEFAULT '0',
          `cd_pessoa` int(11) NOT NULL DEFAULT '0',
          `cd_coligada` smallint(6) unsigned NOT NULL DEFAULT '0',
          PRIMARY KEY (`cd_grupo_pessoa`),
          UNIQUE KEY `cd_grupo_pessoa` (`cd_grupo_pessoa`),
          UNIQUE KEY `UK_USUARIO_COLIGADA` (`cd_pessoa`,`cd_grupo`,`cd_coligada`),
          KEY `IX_CD_GRUPO` (`cd_grupo`),
          KEY `IX_CD_PESSOA` (`cd_pessoa`),
          KEY `IX_CD_COLIGADA` (`cd_coligada`),
          CONSTRAINT `FK_nu_grupos_pessoas_nu_grupos` FOREIGN KEY (`cd_grupo`) REFERENCES `nu_grupos` (`cd_grupo`)
        ) ENGINE=InnoDB AUTO_INCREMENT=2664770 DEFAULT CHARSET=latin1
        ";

        $objComandosSqlService = new ComandosSqlService(
            new PHPSQLParser()
        );

        $objComandosSqlService->parse($ds_sql);
        $arrTabelas = $objComandosSqlService->getArrTabelas();

        //
        $this->assertEquals(
            array(
                array(
                'ds_nome_campo' => '`cd_grupo`',
                'ds_nome_tabela_referencia' => '`nu_grupos`',
                'ds_nome_campo_referencia' => '`cd_grupo`'
                )
            ),
            $arrTabelas[0]['arrForeingkey']
        );
    }
}
