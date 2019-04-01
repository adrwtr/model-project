<?php
namespace Application\Service\Dql;

class RelatorioDqlService
{
    public function getRelatorio() {
        return '
            select
                campo.id,
                campo.ds_nome,
                campo.ds_prop,
                campo.sn_pk,
                tabela.id as nr_tabela_id,
                tabela.ds_nome as ds_tabela_nome
            from
                \Application\Entity\Campo campo

                inner join campo.objTabela tabela

            order by
            campo.nr_ordem asc,
            campo.id asc
        ';
    }
}


