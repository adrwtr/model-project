<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    protected $ds_nome;

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
}