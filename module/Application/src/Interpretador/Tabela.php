<?php
namespace Application\Interpretador;

use Application\Interpretador\Campo;
use Application\Interpretador\Primary;

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

        $arrColunas = $arrTabela['create-def']['sub_tree'];
        $arrCampos = self::processColunas($arrColunas);

        return array(
            'ds_nome' => $ds_nome,
            'arrCampos' => $arrCampos
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
}