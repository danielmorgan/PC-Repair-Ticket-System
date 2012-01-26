<?php
class CustomersController extends AppController {

	var $name = 'Customers';

	function index() {
		$this->Customer->recursive = 0;
		$this->set('customers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid customer', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tickets', $this->Customer->Ticket->find('all',
			array(
				'conditions' => array('Customer.id' => $id)			
			)
		));
		$this->set('customer', $this->Customer->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Customer->create();
			if ($this->Customer->save($this->data)) {
				$this->Session->setFlash(__('The customer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid customer', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Customer->save($this->data)) {
				$this->Session->setFlash(__('The customer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The customer could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Customer->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for customer', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Customer->delete($id)) {
			$this->Session->setFlash(__('Customer deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Customer was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function ajax_names($query = null) {
		$this->autoRender = false;
		
		$suggestions = $this->Customer->find('all', array(
			'conditions' => array('Customer.name LIKE' => "%".$this->params['url']['query']."%"),
			'fields' => array('Customer.name', 'Customer.email', 'Customer.phone', 'Customer.address')
		));
		foreach($suggestions as $suggestion) {
			$names[] = $suggestion['Customer']['name'];
		}
		
		$json = array(
			'query' => $this->params['url']['query'],
			'suggestions' => $names
		);
		return json_encode($json);
	}
	
	function ajax_contact_details($query = null) {
		$this->autoRender = false;
		
		$contact_details = $this->Customer->find('first', array(
			'conditions' => array('Customer.name' => $this->params['url']['query']),
			'fields' => array('Customer.email', 'Customer.phone', 'Customer.address'),
			'recursive' => 0
		));
		
		$json = array(
			'details' => array(
				'id' => $contact_details['Customer']['id'],
				'email' => $contact_details['Customer']['email'],
				'phone' => $contact_details['Customer']['phone'],
				'address' => $contact_details['Customer']['address']
			)
		);
		return json_encode($json);
	}
	
	function search() {
		if ($this->data['Customer']['q'] == '') {
			$this->Session->setFlash(__('No search query submitted', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$results = $this->paginate('Customer', array(
				'Customer.name LIKE' => '%'.$this->data['Customer']['q'].'%'
			));
			$this->set('results', $results);
		} else {
			$this->Session->setFlash(__('No search query submitted', true));
			$this->redirect(array('action' => 'index'));
		}
    } 

}
?>