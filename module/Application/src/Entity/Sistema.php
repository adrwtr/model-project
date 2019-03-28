<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="sistema", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class Sistema
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="ds_nome", nullable=false)
     */
    protected $ds_nome;

    /**
     * @ORM\OneToMany(targetEntity="Tabela", mappedBy="objSistema")
     */
    public $arrTabelas;

    public function __construct() {
        $this->arrTabelas = new ArrayCollection();
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

    public function getArrTabelas() {
        return $this->arrTabelas;
    }

    public function getDsDescricao() {
        return $this->ds_descricao;
    }

    public function setDsDescricao($ds_descricao) {
        $this->ds_descricao = $ds_descricao;
        return $this;
    }

    public function addTabela($objTabela) {
        $objTabela->setObjSistema($this);
        $this->arrTabelas[] = $objTabela;
    }
}