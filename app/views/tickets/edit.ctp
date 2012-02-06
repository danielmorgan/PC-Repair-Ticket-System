<div class="tickets form">
	<fieldset>
		<legend><?php __('Ticket ID: '.$ticket['Ticket']['id']); ?></legend>
		
		
		<div class="col_l">
			<fieldset>
				<legend><?php __('Customer'); ?></legend>
				<dl><?php $i = 0; $class = ' class="altrow"';?>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo $ticket['Customer']['name']; ?>
						&nbsp;
					</dd>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo $ticket['Customer']['email']; ?>
						&nbsp;
					</dd>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phone'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo $ticket['Customer']['phone']; ?>
						&nbsp;
					</dd>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo $ticket['Customer']['address']; ?>
						&nbsp;
					</dd>
					<div id="customerActions">
						<?php
							echo $this->Html->link(
								$this->Html->image('view.png', array('title' => 'View all Tickets for this Customer', 'alt' => 'view')).'View Customer', 
								array('controller' => 'customers', 'action' => 'view', $ticket['Customer']['id']), 
								array('escape' => false)
							);
							echo $this->Html->link(
								$this->Html->image('edit.png', array('title' => 'Edit Customer', 'alt' => 'edit')).'Edit Customer Details', 
								array('controller' => 'customers', 'action' => 'edit', $ticket['Customer']['id']), 
								array('escape' => false)
							);
							echo $this->Html->link(
								$this->Html->image('switch.png', array('title' => 'Change Customer', 'alt' => 'switch')).'Change Customer', 
								array('controller' => 'customers', 'action' => 'change', $ticket['Ticket']['id']), 
								array('escape' => false)
							);
						?>
					</div>
				</dl>
			</fieldset>
			<fieldset>
				<legend><?php __('Metadata'); ?></legend>
				<dl><?php $i = 0; $class = ' class="altrow"';?>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created By'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo $this->Html->link($ticket['User']['username'], array('controller' => 'users', 'action' => 'view', $ticket['User']['id'])); ?>
						&nbsp;
					</dd>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Assigned To'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo $this->Html->link($ticket['AssignedTo']['username'], array('controller' => 'users', 'action' => 'view', $ticket['AssignedTo']['id'])); ?>
						&nbsp;
					</dd>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo date('jS M Y, H:ia', strtotime($ticket['Ticket']['created'])); ?>
						&nbsp;
					</dd>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Modified'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo date('jS M Y, H:ia', strtotime($ticket['Ticket']['modified'])); ?>
						&nbsp;
					</dd>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Due'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo date('jS M Y', strtotime($ticket['Ticket']['due'])); ?>
						&nbsp;
					</dd>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo '<span class="state '.$ticket['State']['name'].'">'.$ticket['State']['name'].'</span>'; ?>
						<?php if (strtotime(date('Y-m-d H:i:s')) > strtotime($ticket['Ticket']['due']) && $ticket['State']['name'] !== 'Resolved') { echo '<span class="state Overdue">Overdue!</span>'; } ?>
						&nbsp;
					</dd>
					<?php if ($ticket['State']['name'] == 'Resolved') { ?>
						<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Closed'); ?></dt>
						<dd<?php if ($i++ % 2 == 0) echo $class;?>>
							<?php echo date('jS M Y, H:ia', strtotime($ticket['Ticket']['closed'])); ?>
							&nbsp;
						</dd>
					<?php } ?>
				</dl>
			</fieldset>
			<div id="changes">
				<h3>Changes/Comments</h3>
				<div id="newChange">
					<fieldset>
						<legend>New comment</legend>
						<?php echo $this->Form->create('Change', array('action' => 'add'));?>
						<?php
						echo $this->Form->input('Change.ticket_id', array('value' => $ticket['Ticket']['id'], 'type' => 'hidden'));
						echo $this->Form->input('Change.change', array('label' => 'Comments', 'type' => 'text'));
						?>
						<?php echo $this->Form->end(__('Add Comment', true));?>
					</fieldset>
				</div>
				<?php foreach ($ticket['Change'] as $change): ?>
					<div class="change">
						<div class="author">
							<?php
								echo 'Posted by '.
								$this->Html->link(
									$assignedTos[$change['user_id']],
									array('controller' => 'users', 'action' => 'view', $change['user_id']
									)
								).
								' &#8212; ';
								echo $this->Time->timeAgoInWords($change['created']);
							?>
						</div>
						<div class="content">
							<?php echo $this->Text->autoLinkUrls($change['change'], array('target' => 'blank'), null, false); ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		
		
		<div class="col_r">
			<fieldset>
				<legend><?php __('Ticket'); ?></legend>
				<?php echo $this->Form->create('Ticket');?>
				<?php				
					if ($ticket['State']['name'] == 'Resolved') {
						echo $this->Form->input('Ticket.subject', array('disabled' => true));
						echo $this->Form->input('Ticket.items', array('label' => 'Items Left (eg. charger, bag, mouse)', 'disabled' => true));
						echo $this->Form->input('Ticket.credentials', array('label' => 'Credentials (eg. usernames, passwords, network settings)', 'disabled' => true));
						echo $this->Form->input('Ticket.notes', array('disabled' => true));
						?>
						<div id="amountInputs">
							<div class="input text required amount">
								<label for="TicketAmountOwed">Amount Owed</label>
								<span class="currencySymbol">&pound;</span><input name="data[Ticket][amount_owed]" type="text" value="<?php echo $ticket['Ticket']['amount_owed']; ?>" maxlength="19" id="TicketAmountOwed" disabled />
							</div>
							<div class="input text required amount">
								<label for="TicketAmountPaid">Amount Paid</label>
								<span class="currencySymbol">&pound;</span><input name="data[Ticket][amount_paid]" type="text" value="<?php echo $ticket['Ticket']['amount_paid']; ?>" maxlength="19" id="TicketAmountPaid" />
							</div>
							<?php $amount_due = $ticket['Ticket']['amount_owed'] - $ticket['Ticket']['amount_paid']; ?>
							<div id="amountDue">Balance Due:<br /><span class="currencySymbol">&pound;</span><span class="amount"><?php echo number_format($amount_due, 2); ?></span></div>
							<div class="clear"></div>
						</div>
						<?php
						echo $this->Form->input('Ticket.assigned_to', array('disabled' => true));
						echo $this->Form->input('Ticket.due', array('default' => date('Y-M-D', mktime()+259200), 'disabled' => true));
						echo $this->Form->input('Ticket.state_id');
					} else {
						echo $this->Form->input('Ticket.subject');
						echo $this->Form->input('Ticket.items', array('label' => 'Items (eg. charger, bag, mouse)'));
						echo $this->Form->input('Ticket.credentials', array('label' => 'Credentials (eg. usernames, passwords, network settings)'));
						echo $this->Form->input('Ticket.notes');
						?>						
						<div id="amountInputs">
							<div class="input text required amount">
								<label for="TicketAmountOwed">Price</label>
								<span class="currencySymbol">&pound;</span><input name="data[Ticket][amount_owed]" type="text" value="<?php echo $ticket['Ticket']['amount_owed']; ?>" maxlength="19" id="TicketAmountOwed" />
							</div>
							<div class="input text required amount">
								<label for="TicketAmountPaid">Amount Paid</label>
								<span class="currencySymbol">&pound;</span><input name="data[Ticket][amount_paid]" type="text" value="<?php echo $ticket['Ticket']['amount_paid']; ?>" maxlength="19" id="TicketAmountPaid" />
							</div>
							<?php $amount_due = $ticket['Ticket']['amount_owed'] - $ticket['Ticket']['amount_paid']; ?>
							<div id="amountDue">Balance Due:<br /><span class="currencySymbol">&pound;</span><span class="amount"><?php echo number_format($amount_due, 2); ?></span></div>
							<div class="clear"></div>
						</div>
						<?php
						echo $this->Form->input('Ticket.assigned_to');
						echo $this->DatePicker->picker('Ticket.due', array('default' => date('Y-M-D', mktime()+259200)));
						echo $this->Form->input('Ticket.state_id');
					}
				?>
				<?php echo $this->Form->end(__('Save Ticket', true));?>
			</fieldset>
		</div>
		
		<div class="clear"></div>
	</fieldset>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('< List Tickets', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $ticket['Ticket']['id']), null, sprintf(__('Are you sure you want to delete #%s? You will not be able to recover it!', true), $ticket['Ticket']['id'])); ?> </li>
	</ul>
</div>