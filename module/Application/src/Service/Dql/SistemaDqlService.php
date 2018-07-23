<?php
namespace Application\Service\Dql;

class SistemaDqlService
{
    public function listaSistemas()
    {
        return 'select s from \Application\Entity\Sistema s'
            . ' order by s.ds_nome asc';
    }
}


