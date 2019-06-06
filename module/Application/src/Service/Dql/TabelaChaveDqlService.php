<?php
namespace Application\Service\Dql;

class TabelaChaveDqlService
{
    public function getCamposChaveFromTabela() {
        return '
            select
                tc.id as id,

                tdc.id as nr_tipo_de_chave_id,
                tdc.ds_nome as ds_nome_chave,

                td.id as tabela_destino_id,
                td.ds_nome as ds_nome_tabela_destino,

                co.id as campo_origem_id,
                co.ds_nome as ds_nome_campo_origem,

                cd.id as campo_destino_id,
                cd.ds_nome as ds_nome_campo_destino
            from
                \Application\Entity\TabelaChave tc

                inner join tc.objTipoDeChave tdc
                inner join tc.objCampoOrigem co
                left join tc.objTabelaDestino td
                left join tc.objCampoDestino cd

            where
                tc.objTabelaOrigem = :tabela_origem_id
            ';
    }
}


