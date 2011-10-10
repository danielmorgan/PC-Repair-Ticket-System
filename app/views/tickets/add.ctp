<div class="tickets form">
<?php echo $this->Form->create('Ticket');?>
	<fieldset>
		<legend><?php __('Add Ticket'); ?></legend>
		<fieldset class="customer form">
			<legend><?php __('Customer'); ?></legend>
			<?php
				echo $this->Form->input('Customer.id', array('type' => 'hidden'));
				echo $this->Form->input('Customer.name');
				echo $this->Form->input('Customer.email');
				echo $this->Form->input('Customer.phone');
				echo $this->Form->input('Customer.address');
			?>
		</fieldset>
		<fieldset class="ticket form">
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
<?php echo $this->Form->end(__('Add Ticket', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('< List Tickets', true), array('action' => 'index'));?></li>
	</ul>
</div>