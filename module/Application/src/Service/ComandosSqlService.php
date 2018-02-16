<?php
namespace Application\Service;

use PHPSQLParser\PHPSQLParser;
use Application\Interpretador\Tabela;

class ComandosSqlService {
	private $arrComandos;
    private $arrTabelas;
    private $objPhpSqlParser;

	public function __construct(\PHPSQLParser\PHPSQLParser $objPhpSqlParser) {
		$this->arrComandos = array();
        $this->arrTabelas = array();
        $this->objPhpSqlParser = $objPhpSqlParser;
	}

    public function parse($ds_sql) {
    	$this->arrComandos = explode(";", $ds_sql);
        $this->parseComandos();
    }

    public function getTotalComandos() {
    	return count($this->arrComandos);
    }

    public function getArrTabelas() {
        return $this->arrTabelas;
    }

    public function parseComandos() {
    	for ($i = 0; $i < $this->getTotalComandos(); $i++) {
            $ds_comando = $this->arrComandos[$i];

            $arrValores = $this->getObjPhpSqlParser()
                ->parse($ds_comando);

            $arrTabela = Tabela::interpretar($arrValores);

            if ($arrTabela != false) {
                $this->arrTabelas[] = $arrTabela;
            }
        }
    }

    private function getObjPhpSqlParser() {
        return $this->objPhpSqlParser;
    }
}


