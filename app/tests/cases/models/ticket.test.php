<?php
/* Ticket Test cases generated on: 2011-10-09 04:21:22 : 1318126882*/
App::import('Model', 'Ticket');

class TicketTestCase extends CakeTestCase {
	var $fixtures = array('app.ticket', 'app.customer', 'app.state');

	function startTest() {
		$this->Ticket =& ClassRegistry::init('Ticket');
	}

	function endTest() {
		unset($this->Ticket);
		ClassRegistry::flush();
	}

}
?>