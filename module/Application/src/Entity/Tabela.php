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
class Tabela implements ITransformable
{
    use Transformable;

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

    public function getDs_nome() {
        return $this->ds_nome;
    }

    public function setDs_nome($ds_nome) {
        $this->ds_nome = $ds_nome;
    }
}