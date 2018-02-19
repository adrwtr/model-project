<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
	private $objSM;

	private function getObjSm() {
		return $this->objSM;
	}

	public function __construct($objSM) {
		$this->objSM = $objSM;
	}

    public function indexAction()
    {
        $entityManager = $this->getObjSm()->get('doctrine.entitymanager.orm_default');

        $post = new \Application\Entity\Post();
        $post->setId(1);
$post->setTitle('Top 10+ Books about Zend Framework 3');
$post->setContent('Post body goes here');
$currentDate = date('Y-m-d H:i:s');
$post->setDateCreated($currentDate);

// Add the entity to entity manager.
$entityManager->persist($post);

// Apply changes to database.
$entityManager->flush();


        return new ViewModel();
    }

    public function lerSqlAction()
    {
    	var_dump($this->getObjSm()->get(\Application\Service\ComandosSqlService::class)->teste()); //->teste();
    	return new ViewModel();
    }
}
