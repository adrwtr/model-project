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
}