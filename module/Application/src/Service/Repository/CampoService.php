<?php
namespace Application\Service\Repository;

use Application\Service\Repository\AbstractRepositoryService;
use Application\Entity\Campo;

class CampoService extends AbstractRepositoryService
{
    public function __construct($objEm) {
        parent::__construct($objEm);
    }

    public function persistir(
        $objTabela,
        $ds_nome,
        $ds_prop = '',
        $ds_descricao = '',
        $sn_pk = 0,
        $nr_ordem = 0,
        $nr_campo_id = null
    ) {
        $objCampo = new Campo();

        // o campo ja existe
        if ($nr_campo_id > 0) {
            $objCampo = $this->getEntityManager()
                ->getRepository(\Application\Entity\Campo::class)
                ->findOneBy([
                    'id' => $nr_campo_id
                ]);
        }

        $objCampo->setObjTabela($objTabela);
        $objCampo->setDsNome($ds_nome);
        $objCampo->setDsProp($ds_prop);
        $objCampo->setDsDescricao($ds_descricao);
        $objCampo->setSnPk($sn_pk);
        $objCampo->setNrOrdem($nr_ordem);

        $this->getEntityManager()
            ->persist($objCampo);

        $this->getEntityManager()
            ->flush();

        return $objCampo;
    }
}


