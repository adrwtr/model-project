<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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

    /**
     * @ORM\OneToMany(targetEntity="Campo", mappedBy="objTabela")
     */
    protected $arrCampos;

    /**
     * @ORM\Column(name="ds_descricao")
     * @ORM\Column(nullable=false)
     * @ORM\Column(type="text")
     */
    protected $ds_descricao;

    public function __construct() {
        $this->arrCampos = new ArrayCollection();
    }


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getDsNome() {
        return $this->ds_nome;
    }

    public function setDsNome($ds_nome) {
        $this->ds_nome = $ds_nome;
        return $this;
    }

    public function getSnTemporario() {
        return $this->sn_temporario;
    }

    public function setSnTemporario($sn_temporario = false) {
        $this->sn_temporario = $sn_temporario;
        return $this;
    }

    public function getSnExcluido() {
        return $this->sn_excluido;
    }

    public function setSnExcluido($sn_excluido = false) {
        $this->sn_excluido = $sn_excluido;
        return $this;
    }

    public function getArrCampos() {
        return $this->arrCampos;
    }

    public function getDsDescricao() {
        return $this->ds_descricao;
    }

    public function setDsDescricao($ds_descricao) {
        $this->ds_descricao = $ds_descricao;
        return $this;
    }
}