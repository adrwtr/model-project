<?php
namespace Application\Service\Dql;

class TabelaDqlService
{
    public function listaTabelas()
    {
        return 'select t from \Application\Entity\Tabela t'
            . ' where t.sn_excluido = 0 and t.sn_temporario = 0'
            . ' and t.objSistema = :nr_sistema_id';
    }

    public function getTabelaById()
    {
        return 'select t from \Application\Entity\Tabela t where t.id = :id';
    }

    public function nativeListaTabelasTemporarias()
    {
        return '
            select
                t.id as id,
                t.ds_nome as ds_nome,
                t_temp.id as id_temp,
                t_temp.ds_nome as ds_nome_temp
            from
                tabela t

                inner join tabela t_temp ON (
                    t_temp.ds_nome = t.ds_nome
                    and t_temp.sn_temporario = 0
                )
            where
                t.sn_temporario = 1
        ';
    }

    public function listaTodasAsTabelas()
    {
        return '
            select
                t.id as id,
                t.ds_nome as ds_nome,
                t_sistema.ds_nome as ds_nome_sistema,
                concat(t_sistema.ds_nome, \' - \', t.ds_nome) as ds_nome_concat
            from
                \Application\Entity\Tabela t

                INNER JOIN \Application\Entity\Sistema t_sistema
            where
                t.sn_excluido = 0 and
                t.sn_temporario = 0
            order by
                t_sistema.ds_nome,
                t.ds_nome
        ';
    }
}


