<?php
/* User Test cases generated on: 2011-10-09 04:21:54 : 1318126914*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.ticket', 'app.customer', 'app.state');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
?>