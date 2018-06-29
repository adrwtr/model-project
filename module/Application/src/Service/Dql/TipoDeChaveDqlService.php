<?php
namespace Application\Service\Dql;

class TipoDeChaveDqlService
{
    public function getTiposDeChave() {
        return '
            select 
                tdc 
            from 
                \Application\Entity\TipoDeChave tdc            
            order by 
                tdc.ds_nome';
    }
}


