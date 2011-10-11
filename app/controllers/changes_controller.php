<?php
class ChangesController extends AppController {

	var $name = 'Changes';
	
	function add() {
		$this->autoRender = false;
		
		if (!empty($this->data)) {
			$this->Change->create();
			$this->Change->set(array(
				'user_id' => $this->Auth->user('id')
			));
			if ($this->Change->save($this->data)) {
				$this->Session->setFlash(__('Comment has been added', true));
				$this->redirect(array('controller' => 'tickets', 'action' => 'edit', $this->data['Change']['ticket_id']));
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.', true));
			}
		}
	}
	
}
?>