<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="conexao", options={"collate"="utf8_general_ci", "charset"="utf8"})
 */
class Conexao {
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
	 * @ORM\Column(name="ds_host", nullable=true)
	 */
	protected $ds_host;

	/**
	 * @ORM\Column(name="ds_login", nullable=true)
	 */
	protected $ds_login;

	/**
	 * @ORM\Column(name="ds_pass", nullable=true)
	 */
	protected $ds_pass;

	public function __construct() {

	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	protected function setDsNome($ds_nome) {
		$this->ds_nome = $ds_nome;
	}

	protected function getDsNome() {
		return $this->ds_nome;
	}

	protected function setDsHost($ds_host) {
		$this->ds_host = $ds_host;
	}

	protected function getDsHost() {
		return $this->ds_host;
	}

	protected function setDsLogin($ds_login) {
		$this->ds_login = $ds_login;
	}

	protected function getDsLogin() {
		return $this->ds_login;
	}

	protected function setDsPass($ds_pass) {
		$this->ds_pass = $ds_pass;
	}

	protected function getDsPass() {
		return $this->ds_pass;
	}
}