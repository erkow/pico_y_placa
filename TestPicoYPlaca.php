<?php 
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once('PicoYPlaca.php');

/**
 * Class TestPicoYPLaca
 * @since   2018-01-11
 * @author  Erick Vaca <erkow@hotmail.com>
  */
class TestPicoYPLaca extends UnitTestCase {

	/*
	* Function to test checkPicoYPlaca
	* @author  Erick Vaca <erkow@hotmail.com>
	* @since   2018-01-11
	*/
	function testCheckPicoYPlaca(){
		//Values to test
		$plate = 'PBC644';
		$date = '09/01/2018';
		$time = '09:31';

		//Expected result
		$canBeOnRoad = true;

		//Initialization
		$pyp = new PicoYPlaca();
		$pyp->setPlate($plate);
		$pyp->setDate($date);
		$pyp->setTime($time);

		$this->assertEqual($pyp->checkPicoYPlaca(),$canBeOnRoad);
	}

}