<?php
namespace Application\Service\Mysql;

class MysqlService {

    private $objConexao;
    private $sn_conectado;
    private $ds_msg_erro;

    public function __construct() {
        $this->objConexao = null;
        $this->sn_conectado = false;
        $this->ds_msg_erro = '';
    }

    public function novaConexao(
        $ds_host,
        $ds_login,
        $ds_senha,
        $ds_database
    ) {
        try {
            $this->objConexao = new \mysqli(
                $ds_host,
                $ds_login,
                $ds_senha
            );

            $this->sn_conectado = true;
        } catch (\Exception $e) {
            $this->sn_conectado = false;
            $this->ds_msg_erro = $e->getMessage();
        }

        if ($this->objConexao->connect_errno) {
            $this->sn_conectado = false;
            $this->ds_msg_erro = $mysqli->connect_error;
        }

        return $this;
    }

    public function executa($ds_sql) {
        if ($this->sn_conectado == false) {
            return [];
        }

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
