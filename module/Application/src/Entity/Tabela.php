<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use \Indaxia\OTR\ITransformable;
use \Indaxia\OTR\Traits\Transformable;
use \Indaxia\OTR\Annotations\Policy;

/**
 * @ORM\Entity
 * @ORM\Table(name="tabela")
 */
class Tabela
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="ds_nome")
     * @ORM\Column(nullable=false)
     */
    protected $ds_nome;

    /**
     * @ORM\Column(name="sn_temporario")
     * @ORM\Column(nullable=false)
     * @ORM\Column(type="boolean")
     * Indica se a tabela e temporaria
     */
    protected $sn_temporario;

    /**
     * @ORM\Column(name="sn_excluido")
     * @ORM\Column(nullable=false)
     * @ORM\Column(type="boolean")
     */
    protected $sn_excluido;



    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDsNome() {
        return $this->ds_nome;
    }

    public function setDsNome($ds_nome) {
        $this->ds_nome = $ds_nome;
    }

    public function getSnTemporario() {
        return $this->sn_temporario;
    }

    public function setSnTemporario($sn_temporario = false) {
        $this->sn_temporario = $sn_temporario;
    }

    public function getSnExcluido() {
        return $this->sn_excluido;
    }

    public function setSnExcluido($sn_excluido = false) {
        $this->sn_excluido = $sn_excluido;
    }
}