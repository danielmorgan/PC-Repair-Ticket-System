<?php
/* Tickets Test cases generated on: 2011-10-09 04:44:05 : 1318128245*/
App::import('Controller', 'Tickets');

class TestTicketsController extends TicketsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TicketsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.ticket', 'app.user', 'app.state', 'app.customer');

	function startTest() {
		$this->Tickets =& new TestTicketsController();
		$this->Tickets->constructClasses();
	}

	function endTest() {
		unset($this->Tickets);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>