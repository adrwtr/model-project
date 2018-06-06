<?php
namespace Application\Interpretador;

use Application\Interpretador\StringCleaner;

class Primary {
    public static function interpretar(
        $arrCampos,
        $arrValores
    ) {
        if (self::validador($arrValores) == false) {
            return $arrCampos;
        }

        $arrProp = $arrValores['sub_tree'];
        $arrSupProp = $arrProp[2]['sub_tree'];
        $ds_campo = $arrSupProp[0]['name'];

        $ds_campo = StringCleaner::removeApostrofo($ds_campo);

        foreach ($arrCampos as $nr_key => $arrCampo) {
            if ($arrCampo['ds_nome'] == $ds_campo) {
                $arrCampos[$nr_key]['sn_pk'] = true;
            }
        }

        return $arrCampos;
    }

    public static function validador($arrValores) {
        if (!isset($arrValores['expr_type'])) {
            return false;
        }

        if (!isset($arrValores['sub_tree'])) {
            return false;
        }

        $sn_campo = false;
        $sn_campo = $arrValores['expr_type'] == 'primary-key';

        if (!$sn_campo) {
            return false;
        }

        return true;
    }
}