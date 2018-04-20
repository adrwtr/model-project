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
        $objTabelaOrigem,
        $objTabelaDestino,
        $objTipoDeChave,
        $objCampoOrigem,
        $objCampoDestino = null,
        $nr_grupo = 0,
        $nr_tabela_chave_id = null
    ) {
        $objTabelaChave = new TabelaChave();

        // é alteracao
        if ($nr_tabela_chave_id > 0) {
            $objTabelaChave = $this->getEntityManager()
                ->getRepository(Tabela::class)
                ->findOneBy([
                    'id' => $nr_tabela_id
                ]);
        }

        $objTabelaChave->setObjTabelaOrigem($objTabelaOrigem);
        $objTabelaChave->setObjTabelaDestino($objTabelaDestino);
        $objTabelaChave->setObjTipoDeChave($objTipoDeChave);
        $objTabelaChave->setObjCampoOrigem($objCampoOrigem);

        if ($objCampoDestino != null) {
            $objTabelaChave->setObjCampoDestino($objCampoDestino);
        }

        $objTabelaChave->setNrGrupo($nr_grupo);


        $this->getEntityManager()
            ->persist($objTabelaChave);

        $this->getEntityManager()
            ->flush();

        return $objTabelaChave;
    }
}


