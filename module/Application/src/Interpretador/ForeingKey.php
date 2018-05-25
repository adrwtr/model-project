<?php
namespace Application\Interpretador;

use Application\Interpretador\StringCleaner;

class ForeingKey {
    public static function interpretar($arrValores) {
        if (self::validador($arrValores) == false) {
            return false;
        }

        $arrProp = $arrValores['sub_tree'];
        $arrCampoReferencia = $arrProp[3]['sub_tree'];
        $ds_nome_campo = $arrCampoReferencia[0]['base_expr'];
        $ds_nome_campo = StringCleaner::removeApostrofo($ds_nome_campo);

        $arrTabelaReferencia = $arrProp[4]['sub_tree'];
        $ds_nome_tabela = $arrTabelaReferencia[1]['table'];
        $ds_nome_tabela = StringCleaner::removeApostrofo($ds_nome_tabela);
        $arrTabelaCampoReferencia = $arrTabelaReferencia[2]['sub_tree'];
        $ds_nome_campo_referencia = $arrTabelaCampoReferencia[0]['base_expr'];
        $ds_nome_campo_referencia = StringCleaner::removeApostrofo($ds_nome_campo_referencia);

        return array(
            'ds_nome_campo' => $ds_nome_campo,
            'ds_nome_tabela_referencia' => $ds_nome_tabela,
            'ds_nome_campo_referencia' => $ds_nome_campo_referencia
        );
    }

    public static function validador($arrValores) {
        if (!isset($arrValores['expr_type'])) {
            return false;
        }

        if (!isset($arrValores['sub_tree'])) {
            return false;
        }

        $sn_campo = false;
        $sn_campo = $arrValores['expr_type'] == 'foreign-key';

        if (!$sn_campo) {
            return false;
        }

        return true;
    }
}