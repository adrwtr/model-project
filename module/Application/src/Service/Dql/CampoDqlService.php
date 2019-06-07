<?php
namespace Application\Service\Dql;

class CampoDqlService
{
    public function getCamposFromTabela() {
        return 'select c from \Application\Entity\Campo c
            where c.objTabela = :tabela_id
            order by c.nr_ordem';
    }

    public function getAllCampos() {
        return 'select
            c.id,
            tabela.id as tabela_id,
            c.ds_nome,
            c.ds_prop,
            c.sn_pk,
            c.ds_descricao,
            c.nr_ordem

        from
            \Application\Entity\Campo c

        inner join c.objTabela tabela

            order by c.nr_ordem';
    }
}


