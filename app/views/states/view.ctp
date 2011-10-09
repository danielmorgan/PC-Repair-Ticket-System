<div class="states view">
<h2><?php  __('State');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $state['State']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $state['State']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit State', true), array('action' => 'edit', $state['State']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete State', true), array('action' => 'delete', $state['State']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $state['State']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List States', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tickets', true), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket', true), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Tickets');?></h3>
	<?php if (!empty($state['Ticket'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('ID'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Assigned To'); ?></th>
		<th><?php __('State Id'); ?></th>
		<th><?php __('Customer Id'); ?></th>
		<th><?php __('Subject'); ?></th>
		<th><?php __('Notes'); ?></th>
		<th><?php __('Items'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Due'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Closed'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($state['Ticket'] as $ticket):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $ticket['id'];?></td>
			<td><?php echo $ticket['user_id'];?></td>
			<td><?php echo $ticket['assigned_to'];?></td>
			<td><?php echo $ticket['state_id'];?></td>
			<td><?php echo $ticket['customer_id'];?></td>
			<td><?php echo $ticket['subject'];?></td>
			<td><?php echo $ticket['notes'];?></td>
			<td><?php echo $ticket['items'];?></td>
			<td><?php echo $ticket['created'];?></td>
			<td><?php echo $ticket['due'];?></td>
			<td><?php echo $ticket['modified'];?></td>
			<td><?php echo $ticket['closed'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'tickets', 'action' => 'view', $ticket['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'tickets', 'action' => 'edit', $ticket['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'tickets', 'action' => 'delete', $ticket['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ticket['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ticket', true), array('controller' => 'tickets', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
