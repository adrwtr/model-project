<?php
namespace Application\Service\Mysql;

class MysqlService {

    private $objConexao;

    public function __construct() {
        $this->objConexao = null;
    }

    public function novaConexao(
        $ds_host,
        $ds_login,
        $ds_senha,
        $ds_database
    ) {
        $this->objConexao = new \mysqli(
            $ds_host,
            $ds_login,
            $ds_senha,
            $ds_database
        );

        if ($this->objConexao->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            die();
        }

        return $this;
    }

    public function executa($ds_sql) {
        $arrResult = $this->getObjConexao()
            ->query(
                $ds_sql,
                MYSQLI_USE_RESULT
            );

        $arrResultados = [];

        while ($row = $arrResult->fetch_array(MYSQLI_ASSOC))
        {
            $arrResultados[] = $this->utf8_string_array_encode($row);
        }

        $arrResult->close();

        return $arrResultados;
    }

    public function fecharConexao() {
        $this->getObjConexao()
            ->close();

        return $this;
    }


    private function getObjConexao() {
        return $this->objConexao;
    }

    private function utf8_string_array_encode(&$array){
        $func = function(&$value,&$key){
            if(is_string($value)){
                $value = utf8_encode($value);
            }
            if(is_string($key)){
                $key = utf8_encode($key);
            }
            if(is_array($value)){
                utf8_string_array_encode($value);
            }
        };
        array_walk($array,$func);
        return $array;
    }
}
