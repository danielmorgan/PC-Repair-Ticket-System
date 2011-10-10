<div class="tickets form">
<?php echo $this->Form->create('Ticket');?>
	<fieldset>
		<legend><?php __('Add Ticket'); ?></legend>
		<fieldset class="ticket">
			<legend><?php __('Ticket'); ?></legend>
			<?php
				echo $this->Form->input('Customer.name', array('label' => 'Customer'));
				echo $this->Form->input('Ticket.subject');
				echo $this->Form->input('Ticket.notes');
				echo $this->Form->input('Ticket.items');
				echo $this->Form->input('Ticket.assigned_to');
				echo $this->Form->input('Ticket.due', array('default' => date('Y-M-D', mktime()+259200)));
			?>
		</fieldset>
	</fieldset>
<?php echo $this->Form->end(__('Save Ticket', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('< List Tickets', true), array('action' => 'index'));?></li>
	</ul>
</div>