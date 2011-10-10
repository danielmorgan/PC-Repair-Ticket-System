<?php
class TicketsController extends AppController {

	var $name = 'Tickets';

	function index() {
		$this->Ticket->recursive = 2;
		$this->paginate = array(
			'Ticket' => array(
				'order' => array(
					'Ticket.state_id' => 'asc',
					'Ticket.due' => 'asc'
				)
			)
		);
		$this->set('tickets', $this->paginate());
	}

	function add() {
		if (!empty($this->data)) {
			$this->Ticket->Customer->create();
			$this->Ticket->Customer->save($this->data);
			$this->Ticket->create();
			$this->Ticket->set(array(
				'user_id' => $this->Auth->user('id'),
				'state_id' => 1,
				'customer_id' => $this->Ticket->Customer->getInsertID()
			));
			if ($this->Ticket->save($this->data)) {
				$this->Session->setFlash(__('The ticket has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.', true));
			}
		}
		$assignedTos = $this->Ticket->User->find('list', array('fields' => array('username')));
		$states = $this->Ticket->State->find('list');
		$customers = $this->Ticket->Customer->find('list');
		$this->set(compact('assignedTos', 'states', 'customers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ticket', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ticket->save($this->data)) {
				$this->Session->setFlash(__('The ticket has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ticket->read(null, $id);
		}
		$users = $this->Ticket->User->find('list');
		$assignedTos = $this->Ticket->User->find('list', array('fields' => array('username')));
		$states = $this->Ticket->State->find('list');
		$customers = $this->Ticket->Customer->find('list');
		$this->set(compact('users', 'assignedTos', 'states', 'customers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ticket', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ticket->delete($id)) {
			$this->Session->setFlash(__('Ticket deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ticket was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>