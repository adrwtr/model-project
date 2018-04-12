<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="tipo_de_chave")
 */
class TipoDeChave
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
     * @ORM\Column(name="ds_chave", nullable=false)
     */
    protected $ds_chave;

    /**
     * @ORM\OneToMany(targetEntity="TabelaChave", mappedBy="objTipoDeChave")
     */
    protected $arrTabelaChave;

    public function __construct() {
        $this->arrTabelaChave = new ArrayCollection();
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

    public function getDsChave() {
        return $this->ds_chave;
    }

    public function setDsChave($ds_chave) {
        $this->ds_chave = $ds_chave;
        return $this;
    }
}