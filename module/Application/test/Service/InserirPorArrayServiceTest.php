<?php
namespace ApplicationTest\Service;

// use PHPUnit\Framework\TestCase;
// use Application\Service\ComandosSqlService;
// use PHPSQLParser\PHPSQLParser;
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

    public function testParseForeingKey() {
        $this->assertQtdRegistro(
            \Application\Entity\Tabela::class,
            0
        );

        $objComandosSqlService = $this->getApplicationServiceLocator()
            ->get(\Application\Service\ComandosSqlService::class);

        $objComandosSqlService->parse(
            $this->getDsSqlForeingKeyDuplo()
        );

        $arrTabelas = $objComandosSqlService->getArrTabelas();

        $this->getApplicationServiceLocator()
            ->get(\Application\Service\InserirPorArrayService::class)
            ->inserirTabelas($arrTabelas);

        $this->assertQtdRegistro(
            \Application\Entity\Tabela::class,
            2
        );



        $this->assertQtdRegistro(
            \Application\Entity\Campo::class,
            11
        );

        $this->assertQtdRegistro(
            \Application\Entity\TabelaChave::class,
            1
        );
    }

    public function testExcluirCampos()
    {
        $objComandosSqlService = $this->getApplicationServiceLocator()
            ->get(\Application\Service\ComandosSqlService::class);

        $objComandosSqlService->parse(
            $this->getDsSql()
        );

        $arrTabelas = $objComandosSqlService->getArrTabelas();

        $objInserirPorArrayService = $this->getApplicationServiceLocator()
            ->get(\Application\Service\InserirPorArrayService::class);

        $objInserirPorArrayService->inserirTabelas($arrTabelas);

        $this->assertQtdRegistro(
            \Application\Entity\Campo::class,
            5
        );

        $arrRegistros = $this->getObjSm()
            ->getRepository(
                \Application\Entity\Campo::class
            )->findAll();

        $objTemp = new \stdClass;
        $objTemp->id= $arrRegistros[0]->getId();

        $arrExcluir = [
            0 => $objTemp
        ];

        $objInserirPorArrayService->excluirCampos(
            $arrExcluir
        );

        $this->assertQtdRegistro(
            \Application\Entity\Campo::class,
            4
        );


        // $arrCamposExcluir =
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

    private function getDsSqlForeingKeyDuplo() {
        return "
        CREATE TABLE `unim_moodle_cursos` (
          `cd_moodle_curso` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `ds_descricao` varchar(255) DEFAULT NULL,
          `ds_sigla` varchar(255) DEFAULT NULL,
          `dt_revisao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
          `cd_integracao_externa` smallint(3) DEFAULT NULL,
          PRIMARY KEY (`cd_moodle_curso`),
          UNIQUE KEY `uk_sigla` (`ds_sigla`)
        ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
        CREATE TABLE `unim_moodle_cursos_disciplinas` (
          `cd_curso_disciplina` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `cd_moodle_curso` int(10) unsigned NOT NULL,
          `nr_anosemestre` smallint(6) unsigned NOT NULL,
          `cd_curso` varchar(15) NOT NULL,
          `cd_turma` varchar(50) NOT NULL,
          `id_disciplina` int(11) unsigned NOT NULL,
          PRIMARY KEY (`cd_curso_disciplina`),
          KEY `unim_mcdf1` (`cd_moodle_curso`),
          KEY `unim_mcdf2` (`nr_anosemestre`,`cd_turma`,`cd_curso`),
          KEY `unim_mcdf3` (`id_disciplina`),
          CONSTRAINT `ufk_mcdf1` FOREIGN KEY (`cd_moodle_curso`) REFERENCES `unim_moodle_cursos` (`cd_moodle_curso`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
        ";
    }
}
