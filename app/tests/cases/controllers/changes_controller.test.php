<?php
/* Changes Test cases generated on: 2011-10-11 13:36:34 : 1318332994*/
App::import('Controller', 'Changes');

class TestChangesController extends ChangesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ChangesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.change', 'app.ticket', 'app.user', 'app.state', 'app.customer');

	function startTest() {
		$this->Changes =& new TestChangesController();
		$this->Changes->constructClasses();
	}

	function endTest() {
		unset($this->Changes);
		ClassRegistry::flush();
	}

}
?>