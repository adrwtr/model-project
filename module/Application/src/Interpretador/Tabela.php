<?php
namespace Application\Interpretador;

use Application\Interpretador\Campo;
use Application\Interpretador\Primary;
use Application\Interpretador\ForeingKey;
use Application\Interpretador\UniqueKey;
use Application\Interpretador\StringCleaner;

class Tabela {
    public static function interpretar($arrValores) {
        if (self::validador($arrValores) == false) {
            return false;
        }

        $ds_nome = '';
        $arrTabela = null;
        $arrColunas = null;
        $arrCampos = array();

        $arrTabela = $arrValores['TABLE'];
        $ds_nome = $arrTabela['name'];
        $ds_nome = StringCleaner::removeApostrofo($ds_nome);

        $arrColunas = $arrTabela['create-def']['sub_tree'];

        $arrCampos = self::processColunas($arrColunas);
        $arrForeingkey = self::processForeingKeys($arrColunas);
        $arrUniquekey = self::processUniqueKeys($arrColunas);

        return array(
            'ds_nome' => $ds_nome,
            'arrCampos' => $arrCampos,
            'arrForeingkey' => $arrForeingkey,
            'arrUniquekey' => $arrUniquekey
        );
    }

    public static function validador($arrValores) {
        if (!isset($arrValores['CREATE'])) {
            return false;
        }

        $sn_tabela = false;
        $sn_tabela = $arrValores['CREATE']['expr_type'] == 'table';

        if (!$sn_tabela) {
            return false;
        }

        return true;
    }

    private static function processColunas($arrColunas) {
        $arrCampos = array();

        foreach ($arrColunas as $arrColuna) {

            // intepreta os campos
            $arrCampo = Campo::interpretar($arrColuna);

            if ($arrCampo != false) {
                $arrCampos[] = $arrCampo;
            }

            // intepreta as primarys
            $arrCampos = Primary::interpretar(
                $arrCampos,
                $arrColuna
            );

        }

        return $arrCampos;
    }

    private static function processForeingKeys($arrColunas) {
        $arrForeingkey = array();
        $arrForeingkeys = array();

        foreach ($arrColunas as $arrColuna) {
            $arrForeingkey = ForeingKey::interpretar($arrColuna);

            if ($arrForeingkey != false) {
                $arrForeingkeys[] = $arrForeingkey;
            }
        }

        return $arrForeingkeys;
    }

    private static function processUniqueKeys($arrColunas) {
        $arrUniqueKey = array();
        $arrUniqueKeys = array();

        foreach ($arrColunas as $arrColuna) {
            $arrUniqueKey = UniqueKey::interpretar($arrColuna);

            if ($arrUniqueKey != false) {
                $arrUniqueKeys[] = $arrUniqueKey;
            }
        }

        return $arrUniqueKeys;
    }
}