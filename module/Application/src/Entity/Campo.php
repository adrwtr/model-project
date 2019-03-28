<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="campo", options={"collate"="utf8_general_ci", "charset"="utf8"})
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
     * @ORM\Column(name="ds_descricao", type="text", nullable=true)
     */
    protected $ds_descricao;

    /**
     * @ORM\Column(name="nr_ordem", nullable=false, type="integer")
     */
    protected $nr_ordem;

    /**
     * @ORM\ManyToOne(targetEntity="Tabela", inversedBy="arrCampos")
     * @ORM\JoinColumn(name="tabela_id", referencedColumnName="id")
     */
    private $objTabela;

    /**
     * @ORM\OneToMany(targetEntity="TabelaChave", mappedBy="objCampoOrigem")
     */
    protected $arrTabelaChaveCampoOrigem;

    /**
     * @ORM\OneToMany(targetEntity="TabelaChave", mappedBy="objCampoDestino")
     */
    protected $arrTabelaChaveCampoDestino;

    public function __construct() {
        $this->arrTabelaChaveCampoOrigem = new ArrayCollection();
        $this->arrTabelaChaveCampoDestino = new ArrayCollection();
    }

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

    public function getDsDescricao() {
        return $this->ds_descricao;
    }

    public function setDsDescricao($ds_descricao) {
        $this->ds_descricao = $ds_descricao;
        return $this;
    }

    public function getNrOrdem() {
        return $this->nr_ordem;
    }

    public function setNrOrdem($nr_ordem) {
        $this->nr_ordem = $nr_ordem;
        return $this;
    }

    public function addTabelaChaveOrigem($objTabelaChave) {
        $objTabelaChave->setObjTabela($this);
        $this->arrTabelaChaveCampoOrigem[] = $objTabelaChave;
    }

    public function addTabelaChaveDestino($objTabelaChave) {
        $objTabelaChave->setObjTabela($this);
        $this->arrTabelaChaveCampoDestino[] = $objTabelaChave;
    }
}