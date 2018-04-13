<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Pode incluir nesta entidade - Unique keys, foreing keys e chaves lógicas
 *
 * @ORM\Entity
 * @ORM\Table(name="tabela_chave")
 */
class TabelaChave
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Tabela", inversedBy="arrTabelaChaveOrigem")
     * @ORM\JoinColumn(name="tabela_origem_id", referencedColumnName="id")
     */
    private $objTabelaOrigem;

    /**
     * @ORM\Column(name="tabela_destino_id", nullable=true)
     * @ORM\ManyToOne(targetEntity="Tabela", inversedBy="arrTabelaChaveDestino")
     * @ORM\JoinColumn(name="tabela_destino_id", referencedColumnName="id")
     */
    private $objTabelaDestino;

    /**
     * @ORM\ManyToOne(targetEntity="TipoDeChave", inversedBy="arrTabelaChave")
     * @ORM\JoinColumn(name="tipo_de_chave_id", referencedColumnName="id")
     */
    private $objTipoDeChave;

    /**
     * @ORM\ManyToOne(targetEntity="Campo", inversedBy="arrTabelaChaveCampoOrigem")
     * @ORM\JoinColumn(name="campo_origem_id", referencedColumnName="id")
     */
    private $objCampoOrigem;

    /**
     * @ORM\ManyToOne(targetEntity="Campo", inversedBy="arrTabelaChaveCampoDestino")
     * @ORM\JoinColumn(name="campo_destino_id", referencedColumnName="id")
     */
    private $objCampoDestino;

    /**
     * @ORM\Column(name="nr_grupo", nullable=false, type="integer")
     */
    protected $nr_grupo;

    public function __construct() {
        $this->nr_grupo = 0;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getObjTabelaOrigem()
    {
        return $this->objTabelaOrigem;
    }

    public function setObjTabelaOrigem($objTabelaOrigem)
    {
        $this->objTabelaOrigem = $objTabelaOrigem;
        return $this;
    }

    public function getObjTabelaDestino()
    {
        return $this->objTabelaDestino;
    }

    public function setObjTabelaDestino($objTabelaDestino)
    {
        $this->objTabelaDestino = $objTabelaDestino;
        return $this;
    }

    public function getObjTipoDeChave()
    {
        return $this->objTipoDeChave;
    }

    public function setObjTipoDeChave($objTipoDeChave)
    {
        $this->objTipoDeChave = $objTipoDeChave;
        return $this;
    }

    public function getObjCampoOrigem()
    {
        return $this->objCampoOrigem;
    }

    public function setObjCampoOrigem($objCampoOrigem)
    {
        $this->objCampoOrigem = $objCampoOrigem;
        return $this;
    }

    public function getObjCampoDestino()
    {
        return $this->objCampoDestino;
    }

    public function setObjCampoDestino($objCampoDestino)
    {
        $this->objCampoDestino = $objCampoDestino;
        return $this;
    }

    public function getNrGrupo()
    {
        return $this->nr_grupo;
    }

    public function setNrGrupo($nr_grupo)
    {
        $this->nr_grupo = $nr_grupo;

        return $this;
    }
}