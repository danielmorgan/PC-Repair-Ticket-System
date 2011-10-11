<?php
/* Change Test cases generated on: 2011-10-11 13:36:10 : 1318332970*/
App::import('Model', 'Change');

class ChangeTestCase extends CakeTestCase {
	var $fixtures = array('app.change', 'app.ticket', 'app.user', 'app.state', 'app.customer');

	function startTest() {
		$this->Change =& ClassRegistry::init('Change');
	}

	function endTest() {
		unset($this->Change);
		ClassRegistry::flush();
	}

}
?>