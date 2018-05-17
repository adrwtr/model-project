<?php
namespace Application\Service\Dql;

class CampoDqlService
{
    public function getCamposFromTabela() {
        return 'select c from \Application\Entity\Campo c
            where c.objTabela = :tabela_id
            order by c.nr_ordem';
    }
}


