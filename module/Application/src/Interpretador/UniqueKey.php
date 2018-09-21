<?php
namespace Application\Interpretador;

use Application\Interpretador\StringCleaner;

class UniqueKey {
    public static function interpretar($arrValores) {
        if (self::validador($arrValores) == false) {
            return false;
        }

        $arrProp = $arrValores['sub_tree'];
        $ds_nome_uk = $arrProp[1]['base_expr'];
        $ds_nome_uk = StringCleaner::removeApostrofo($ds_nome_uk);

        // campos da uk
        $arrCampos = $arrProp[2]['sub_tree'];
        $arrCamposUk = [];

        foreach ($arrCampos as $key => $arrCampo) {
            $ds_nome_campo = $arrCampo['base_expr'];
            $ds_nome_campo = str_replace(',', '', $ds_nome_campo);
            $ds_nome_campo = StringCleaner::removeApostrofo($ds_nome_campo);
            $arrCamposUk[] = $ds_nome_campo;
        }

        return array(
            'ds_nome_uk' => $ds_nome_uk,
            'arrCamposUk' => $arrCamposUk
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
        $sn_campo = $arrValores['expr_type'] == 'index';

        if (!$sn_campo) {
            return false;
        }

        $sn_unique = false;

        $sn_unique = substr($arrValores['base_expr'], 0, 10) == 'UNIQUE KEY';

        if (!$sn_unique) {
            return false;
        }

        return true;
    }
}