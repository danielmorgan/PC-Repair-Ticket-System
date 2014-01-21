<?php
class TicketsController extends AppController {

	var $name = 'Tickets';

	function index() {
		$this->Ticket->recursive = 1;
		$this->paginate = array(
			'Ticket' => array(
				'order' => array(
					'Ticket.state_id' => 'asc',
					'Ticket.due' => 'desc',
					'Ticket.created' => 'asc'
				)
			)
		);
		$this->set('tickets', $this->paginate());
	}

	function add() {
		if (!empty($this->data)) {
		
			if ($this->data['Customer']['id'] == '') {
				$this->Ticket->Customer->create();
				$this->Ticket->Customer->save($this->data);
				$customer_id = $this->Ticket->Customer->getInsertID();
			} else {
				$customer_id = $this->data['Customer']['id'];
			}
			
			$this->Ticket->create();
			$this->Ticket->set(array(
				'user_id' => $this->Auth->user('id'),
				'state_id' => 1,
				'customer_id' => $customer_id
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
		
			// Set closed date if ticket set to resolved
			if ($this->data['Ticket']['state_id'] == 4) {
				$this->Ticket->set(array(
					'closed' => date('Y-m-d H:i:s')
				));
			}
			
			// Make a new change showing how the state has been modified
			$findState = $this->Ticket->find('first', array(
				'conditions' => array('Ticket.id' => $id),
				'fields' => array('State.id'),
				'recursive' => 0
			));
			if($this->data['Ticket']['state_id'] !== $findState['State']['id']) {
				$states = $this->Ticket->State->find('list');
				$this->Ticket->Change->create();
				$this->Ticket->Change->set(array(
					'user_id' => $this->Auth->user('id'),
					'ticket_id' => $id,
					'change' => 'State changed from <span class="state '.$states[$findState['State']['id']].'">'.$states[$findState['State']['id']].'</span> &rarr; <span class="state '.$states[$this->data['Ticket']['state_id']].'">'.$states[$this->data['Ticket']['state_id']].'</span>'
				));
				$this->Ticket->Change->save();
			}
			
			
			if ($this->Ticket->save($this->data)) {
				$this->Session->setFlash(__('The ticket has been saved', true));
				$this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ticket->read(null, $id);
			$this->recursive = 1;
			$ticket = $this->Ticket->find('first', array(
				'conditions' => array('Ticket.id' => $id)
			));
		}
		$users = $this->Ticket->User->find('list');
		$assignedTos = $this->Ticket->User->find('list', array('fields' => array('username')));
		$states = $this->Ticket->State->find('list');
		$customers = $this->Ticket->Customer->find('list');
		$this->set(compact('users', 'assignedTos', 'states', 'customers', 'ticket'));
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