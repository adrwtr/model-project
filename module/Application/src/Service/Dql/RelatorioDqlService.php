<?php
namespace Application\Service\Dql;

class RelatorioDqlService
{
    public function getRelatorioTabelaCampo()
    {
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

    public function getRelatorioFK() {
        return '
             select
                tc.id as id,

                tdc.id as nr_tipo_de_chave_id,
                tdc.ds_nome as ds_nome_chave,

                to.id as tabela_origem_id,
                to.ds_nome as ds_nome_tabela_origem,

                td.id as tabela_destino_id,
                td.ds_nome as ds_nome_tabela_destino,

                co.id as campo_origem_id,
                co.ds_nome as ds_nome_campo_origem,

                cd.id as campo_destino_id,
                cd.ds_nome as ds_nome_campo_destino
            from
                \Application\Entity\TabelaChave tc

                inner join tc.objTipoDeChave tdc
                inner join tc.objTabelaOrigem to
                inner join tc.objTabelaDestino td
                inner join tc.objCampoOrigem co
                inner join tc.objCampoDestino cd
            where
                tdc.ds_chave = \'FOREING_KEY\'
                or tdc.ds_chave = \'LOGIC_KEY\'
            order by
                to.id asc,
                to.ds_nome asc
        ';
    }
}


