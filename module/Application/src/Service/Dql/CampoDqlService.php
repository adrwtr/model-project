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
            c.ds_nome,
            c.ds_prop,
            c.sn_pk,
            c.ds_descricao,
            t.ds_nome as ds_nome_tabela,
            t.ds_descricao as ds_descricao_tabela

        from \Application\Entity\Campo c
            inner join c.objTabela as t
            order by t.id, c.ds_nome';
    }
}


