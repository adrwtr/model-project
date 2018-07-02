<?php
namespace Application\Service\Dql;

class TabelaDqlService
{
    public function listaTabelas()
    {
        return 'select t from \Application\Entity\Tabela t'
            . ' where t.sn_excluido = 0 and t.sn_temporario = 0';
    }

    public function getTabelaById()
    {
        return 'select t from \Application\Entity\Tabela t where t.id = :id';
    }

    public function listaTabelasTemporarias()
    {
        return '
            select
                t.id as id,
                t.ds_nome as ds_nome,
                t_temp.id as id_temp,
                t_temp.ds_nome as ds_nome_temp
            from 
                \Application\Entity\Tabela t
                
                inner join \Application\Entity\Tabela t_temp ON (
                    t_temp.ds_nome = t.ds_nome
                    and t_temp.sn_temporario = 0
                )
            where
                t.sn_temporario = 1
        ';
    }
}


