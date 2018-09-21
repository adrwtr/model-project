<?php
namespace Application\Service\Repository;

use Application\Entity\TipoDeChave;
use Application\Service\Repository\AbstractRepositoryService;

class TipoDeChaveService extends AbstractRepositoryService
{
    public function __construct($objEm)
    {
        parent::__construct($objEm);
    }

    public function persistir(
        $ds_nome,
        $ds_chave = '',
        $nr_tipo_de_chave_id = null
    ) {
        $objTipoDeChave = new TipoDeChave();

        // é alteracao
        if ($nr_tipo_de_chave_id > 0) {
            $objTipoDeChave = $this->getEntityManager()
                ->getRepository(TipoDeChave::class)
                ->findOneBy([
                    'id' => $nr_tipo_de_chave_id,
                ]);
        }

        $objTipoDeChave->setDsNome($ds_nome);
        $objTipoDeChave->setDsChave($ds_chave);

        $this->getEntityManager()
            ->persist($objTipoDeChave);

        $this->getEntityManager()
            ->flush();

        return $objTipoDeChave;
    }

    public function getTipoDeChaveForingKey() {
        // buscando a chave
        $objTipoDeChave = $this->getEntityManager()
            ->getRepository(\Application\Entity\TipoDeChave::class)
            ->findOneBy([
                'ds_chave' => \Application\Entity\TipoDeChave::FOREING_KEY
            ]);

        if ($objTipoDeChave == null) {
            $objTipoDeChave = $this->persistir(
                'Foreing Key',
                \Application\Entity\TipoDeChave::FOREING_KEY
            );
        }

        return $objTipoDeChave;
    }

    public function getTipoDeChaveUniqueKey() {
        // buscando a chave
        $objTipoDeChave = $this->getEntityManager()
            ->getRepository(\Application\Entity\TipoDeChave::class)
            ->findOneBy([
                'ds_chave' => \Application\Entity\TipoDeChave::UNIQUE_KEY
            ]);

        if ($objTipoDeChave == null) {
            $objTipoDeChave = $this->persistir(
                'Unique Key',
                \Application\Entity\TipoDeChave::UNIQUE_KEY
            );
        }

        return $objTipoDeChave;
    }
}
