<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="campo")
 */
class Campo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Tabela", inversedBy="arrCampos")
     * @ORM\JoinColumn(name="tabela_id", referencedColumnName="id")
     */
    private $objTabela;

    /**
     * @ORM\Column(name="ds_nome", nullable=false)
     */
    protected $ds_nome;

    /**
     * @ORM\Column(name="ds_prop", nullable=true)
     */
    protected $ds_prop;

    /**
     * @ORM\Column(name="sn_pk", type="boolean", nullable=false)
     */
    protected $sn_pk;

    /**
     * @ORM\Column(name="me_descricao", type="text", nullable=true)
     */
    protected $me_descricao;

    /**
     * @ORM\Column(name="nr_ordem", nullable=false, type="integer")
     */
    protected $nr_ordem;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getObjTabela() {
        return $this->objTabela;
    }

    public function setObjTabela($objTabela) {
        $this->objTabela = $objTabela;
        return $this;
    }

    public function getDsNome() {
        return $this->ds_nome;
    }

    public function setDsNome($ds_nome) {
        $this->ds_nome = $ds_nome;
        return $this;
    }

    public function getDsProp() {
        return $this->ds_prop;
    }

    public function setDsProp($ds_prop) {
        $this->ds_prop = $ds_prop;
        return $this;
    }

    public function getSnPk() {
        return $this->sn_pk;
    }

    public function setSnPk($sn_pk = false) {
        $this->sn_pk = $sn_pk;
        return $this;
    }

    public function getMeDescricao() {
        return $this->me_descricao;
    }

    public function setMeDescricao($me_descricao) {
        $this->me_descricao = $me_descricao;
        return $this;
    }

    public function getNrOrdem() {
        return $this->nr_ordem;
    }

    public function setNrOrdem($nr_ordem) {
        $this->nr_ordem = $nr_ordem;
        return $this;
    }
}