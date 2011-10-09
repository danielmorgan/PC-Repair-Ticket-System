<?php
/* State Test cases generated on: 2011-10-09 04:19:56 : 1318126796*/
App::import('Model', 'State');

class StateTestCase extends CakeTestCase {
	var $fixtures = array('app.state', 'app.ticket', 'app.customer');

	function startTest() {
		$this->State =& ClassRegistry::init('State');
	}

	function endTest() {
		unset($this->State);
		ClassRegistry::flush();
	}

}
?>