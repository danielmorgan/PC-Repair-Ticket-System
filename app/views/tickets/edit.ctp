<div class="tickets form">
<?php echo $this->Form->create('Ticket');?>
	<fieldset>
		<legend><?php __('Edit Ticket'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('assigned_to');
		echo $this->Form->input('state_id');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('subject');
		echo $this->Form->input('notes');
		echo $this->Form->input('items');
		echo $this->Form->input('due');
		echo $this->Form->input('closed');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Ticket.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Ticket.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tickets', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List States', true), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State', true), array('controller' => 'states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers', true), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer', true), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>