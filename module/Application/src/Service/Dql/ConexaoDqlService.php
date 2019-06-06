<?php
namespace Application\Service\Dql;

class ConexaoDqlService
{
    public function getAllConexao() {
        return 'select c from \Application\Entity\Conexao c
            order by c.ds_nome';
    }

}


