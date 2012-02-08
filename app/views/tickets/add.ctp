<div class="tickets add form">
<?php echo $this->Form->create('Ticket');?>
	<fieldset>
		<legend><?php __('Add Ticket'); ?></legend>
		
		<div class="col_l">
			<fieldset>
				<legend><?php __('Customer'); ?></legend>
				<?php
					echo $this->Form->input('Customer.id', array('type' => 'hidden'));
					echo $this->Form->input('Customer.name');
					echo $this->Form->input('Customer.email');
					echo $this->Form->input('Customer.phone');
					echo $this->Form->input('Customer.address');
				?>
			</fieldset>
		</div>
		
		<div class="col_r">
			<fieldset>
				<legend><?php __('Ticket'); ?></legend>
				<?php
					echo $this->Form->input('Ticket.subject');
					echo $this->Form->input('Ticket.items', array('type' => 'text', 'label' => 'Items Left'));
					echo $this->Form->input('Ticket.credentials', array('type' => 'text', 'label' => 'Credentials'));
					echo $this->Form->input('Ticket.notes');
				?>
				<div id="amountInputs">
					<div class="input text required amount">
						<label for="TicketAmountOwed">Price</label>
						<span class="currencySymbol">&pound;</span><input name="data[Ticket][amount_owed]" type="text" value="0" maxlength="19" id="TicketAmountOwed" />
					</div>
					<div class="input text required amount">
						<label for="TicketAmountPaid">Amount Paid</label>
						<span class="currencySymbol">&pound;</span><input name="data[Ticket][amount_paid]" type="text" value="0" maxlength="19" id="TicketAmountPaid" />
					</div>
					<div id="amountDue">Balance Due:<br /><span class="currencySymbol">&pound;</span><span class="amount"><?php echo number_format(0, 2); ?></span></div>
					<div class="clear"></div>
				</div>
				<?php
					echo $this->Form->input('Ticket.assigned_to');
					echo $this->DatePicker->picker('Ticket.due', array('default' => date('Y-M-D', mktime()+259200)));
					echo $this->Form->input('Ticket.state_id');
				?>				
				<?php echo $this->Form->end(__('Add Ticket', true));?>
			</fieldset>
		</div>
		
		<div class="clear"></div>
		
	</fieldset>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('< List Tickets', true), array('action' => 'index'));?></li>
	</ul>
</div>