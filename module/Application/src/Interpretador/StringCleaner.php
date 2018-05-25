<?php
namespace Application\Interpretador;

class StringCleaner
{
    public static function removeApostrofo($ds_valor)
    {
        $ds_valor = str_replace(
            "`",
            '',
            $ds_valor
        );

        return $ds_valor;
    }
}
