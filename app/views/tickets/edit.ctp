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
		<li><?php echo $this->Html->link(__('< List Tickets', true), array('action' => 'index'));?></li>
	</ul>
</div>