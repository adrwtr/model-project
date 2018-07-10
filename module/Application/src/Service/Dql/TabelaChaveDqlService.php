<?php
namespace Application\Service\Dql;

class TabelaChaveDqlService
{
    public function getCamposChaveFromTabela() {
        return '
            select
              tc
            from 
                \Application\Entity\TabelaChave tc
            where
                tc.objTabelaOrigem = :tabela_origem_id
            ';

        // -- ,
        //
        //tc.id as id,
        //                tc.tabela_origem_id as tabela_origem_id,
        //                tc.tabela_destino_id as tabela_destino_id,
        //                tc.campo_origem_id as campo_origem_id,
        //                tc.campo_destino_id as campo_destino_id
        //
        //                tp.ds_nome as ds_nome_chave
/*
                inner join \Application\Entity\TipoDeChave tp ON (
                    tp.id = tc.tipo_de_chave_id
                )
            where
                tc.tabela_origem_id = :tabela_origem_id
        ';*/
    }
}


