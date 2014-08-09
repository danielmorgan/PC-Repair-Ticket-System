<?php
class AppController extends Controller {
    var $components = array('Auth', 'Session');
    var $helpers = array('Html', 'Time', 'Form', 'Session', 'Javascript', 'DatePicker', 'Text');

    function beforeFilter() {
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'tickets', 'action' => 'index');
    }

	function beforeRender() {
		$this->set('loggedin', $this->Auth->user());
	}

}
?>
