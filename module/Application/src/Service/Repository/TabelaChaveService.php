<?php
namespace Application\Service\Repository;

use Application\Service\Repository\AbstractRepositoryService;
use Application\Entity\TabelaChave;

class TabelaChaveService extends AbstractRepositoryService
{
    public function __construct($objEm) {
        parent::__construct($objEm);
    }

    public function persistir(
        $ds_nome,
        $ds_chave = '',
        $nr_tabela_chave_id = null
    ) {
        $objTabela = new Tabela();

        // é alteracao
        if ($nr_tabela_chave_id > 0) {
            $objTabela = $this->getEntityManager()
                ->getRepository(Tabela::class)
                ->findOneBy([
                    'id' => $nr_tabela_id
                ]);
        }

        $objTabela->setDsNome($ds_tabela);
        $objTabela->setSnExcluido(false);
        $objTabela->setSnTemporario(false);
        $objTabela->setDsDescricao($ds_descricao);

        // é uma nova? verifica por duplicadas
        if ($nr_tabela_id == null) {
            $objTabelaDuplicada = $this->getEntityManager()
                ->getRepository(Tabela::class)
                ->findOneBy([
                    'ds_nome' => $ds_tabela
                ]);

            // se ela ja existir, indica que é duplicada
            if ($objTabelaDuplicada != null) {
                $objTabela->setSnTemporario(true);
            }
        }

        $this->getEntityManager()
            ->persist($objTabela);

        $this->getEntityManager()
            ->flush();

        return $objTabela;
    }
}


