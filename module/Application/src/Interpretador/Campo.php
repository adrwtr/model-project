<?php
namespace Application\Interpretador;

class Campo {
    public static function interpretar($arrValores) {
        if (self::validador($arrValores) == false) {
            return false;
        }

        $arrProp = $arrValores['sub_tree'];
        $ds_nome = $arrProp[0]['base_expr'];
        $ds_prop = $arrProp[1]['base_expr'];

        return array(
            'ds_nome' => $ds_nome,
            'ds_prop' => $ds_prop,
            'sn_pk'   => false
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
        $sn_campo = $arrValores['expr_type'] == 'column-def';

        if (!$sn_campo) {
            return false;
        }

        return true;
    }
} 