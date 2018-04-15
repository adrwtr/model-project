<?php
namespace Application\Service\Dql;

class TabelaDqlService
{
    public function listaTabelas() {
        return 'select t from \Application\Entity\Tabela t'
            . ' where t.sn_excluido = 0 and t.sn_temporario = 0';
    }

    public function getTabelaById() {
        return 'select t from \Application\Entity\Tabela t where t.id = :id';
    }
}


