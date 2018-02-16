<?php
namespace ApplicationTest\Controller;

use Application\Controller\IndexController;
use Zend\Stdlib\ArrayUtils;
use PHPUnit\Framework\TestCase;
use PHPSQLParser\PHPSQLParser;

class IndexControllerTest  extends TestCase
{
    public function testPhpsqlparser()
    {
    	$parser = new PHPSQLParser();

		$parser->parse('CREATE TABLE t1 (col1 INT, col2 CHAR(5));');
		$arr = $parser->parsed;

        $this->assertTrue(count($arr) == 2);
    }
}