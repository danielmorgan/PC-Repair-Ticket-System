<div class="tickets index">
	<h2><?php __('Tickets');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('assigned_to');?></th>
			<th><?php echo $this->Paginator->sort('state_id');?></th>
			<th><?php echo $this->Paginator->sort('customer_id');?></th>
			<th><?php echo $this->Paginator->sort('subject');?></th>
			<th><?php echo $this->Paginator->sort('notes');?></th>
			<th><?php echo $this->Paginator->sort('items');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('due');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('closed');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($tickets as $ticket):
		$class = null;
		$state = $ticket['State']['name'];
	?>
	<tr class="<?php echo $state; ?>">
		<td><?php echo $ticket['Ticket']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ticket['User']['username'], array('controller' => 'users', 'action' => 'view', $ticket['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ticket['AssignedTo']['username'], array('controller' => 'users', 'action' => 'view', $ticket['AssignedTo']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ticket['State']['name'], array('controller' => 'states', 'action' => 'view', $ticket['State']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ticket['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $ticket['Customer']['id'])); ?>
		</td>
		<td><?php echo $ticket['Ticket']['subject']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['notes']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['items']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['created']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['due']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['modified']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['closed']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $ticket['Ticket']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $ticket['Ticket']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $ticket['Ticket']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ticket['Ticket']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Ticket', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List States', true), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State', true), array('controller' => 'states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers', true), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer', true), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>