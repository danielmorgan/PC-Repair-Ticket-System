<div class="tickets form">
<?php echo $this->Form->create('Ticket');?>
	<fieldset>
		<legend><?php __('Add Ticket'); ?></legend>
		<fieldset>
			<legend><?php __('Customer'); ?></legend>
			<?php
				echo $this->Form->input('Customer.name');
				echo $this->Form->input('Customer.email');
				echo $this->Form->input('Customer.phone');
				echo $this->Form->input('Customer.address');
			?>
		</fieldset>
		<fieldset>
			<legend><?php __('Ticket'); ?></legend>
			<?php
				echo $this->Form->input('Ticket.subject');
				echo $this->Form->input('Ticket.notes');
				echo $this->Form->input('Ticket.items');
				echo $this->Form->input('Ticket.assigned_to');
				echo $this->Form->input('Ticket.due', array('default' => date('Y-M-D', mktime()+259200)));
			?>
		</fieldset>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tickets', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List States', true), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State', true), array('controller' => 'states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers', true), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer', true), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>