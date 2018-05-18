<?php
namespace Application\Service\Repository;

abstract class AbstractRepositoryService
{
    private $objEm;

    public function __construct($objEm) {
        $this->objEm = $objEm;
    }

    public function getEntityManager() {
        return $this->objEm;
    }

    public function tratarString($ds_valor) {
        $ds_valor = str_replace(
            "`",
            '',
            $ds_valor
        );

        return $ds_valor;
    }
}