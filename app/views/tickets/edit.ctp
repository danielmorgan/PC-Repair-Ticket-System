<div class="tickets form">
<?php echo $this->Form->create('Ticket');?>
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
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phone'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo $ticket['Customer']['phone']; ?>
						&nbsp;
					</dd>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo $ticket['Customer']['email']; ?>
						&nbsp;
					</dd>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo $ticket['Customer']['address']; ?>
						&nbsp;
					</dd>
				</dl>
			</fieldset>
			<fieldset>
				<legend><?php __('Metadata'); ?></legend>
				<dl><?php $i = 0; $class = ' class="altrow"';?>
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
		</div>
		
		<div class="col_r">
			<fieldset>
				<legend><?php __('Ticket'); ?></legend>
				<?php				
					if ($ticket['State']['name'] == 'Resolved') {
						echo $this->Form->input('Ticket.subject', array('disabled' => true));
						echo $this->Form->input('Ticket.notes', array('disabled' => true));
						echo $this->Form->input('Ticket.items', array('disabled' => true));
						echo $this->Form->input('Ticket.assigned_to', array('disabled' => true));
						echo $this->Form->input('Ticket.due', array('default' => date('Y-M-D', mktime()+259200), 'disabled' => true));
						echo $this->Form->input('Ticket.state_id');
					} else {
						echo $this->Form->input('Ticket.subject');
						echo $this->Form->input('Ticket.notes');
						echo $this->Form->input('Ticket.items');
						echo $this->Form->input('Ticket.assigned_to');
						echo $this->Form->input('Ticket.due', array('default' => date('Y-M-D', mktime()+259200)));
						echo $this->Form->input('Ticket.state_id');
					}
				?>
			</fieldset>
		</div>
		
		<div class="clear"></div>
	</fieldset>
<?php echo $this->Form->end(__('Save Ticket', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('< List Tickets', true), array('action' => 'index'));?></li>
	</ul>
</div>