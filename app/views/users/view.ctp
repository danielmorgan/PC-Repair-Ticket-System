<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tickets', true), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ticket', true), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Assigned Tickets');?></h3>
	<?php if (!empty($user['AssignedTicket'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('ID'); ?></th>
		<th><?php __('Customer'); ?></th>
		<th><?php __('Subject'); ?></th>
		<th><?php __('Notes'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Due'); ?></th>
		<th><?php __('State Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tickets as $ticket):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $ticket['Ticket']['id'];?></td>
			<td><?php echo $this->Html->link($ticket['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $ticket['Customer']['id'])); ?></td>
			<td><?php echo $ticket['Ticket']['subject'];?></td>
			<td><?php echo $ticket['Ticket']['notes'];?></td>
			<td><?php echo date('jS M Y', strtotime($ticket['Ticket']['created'])); ?>&nbsp;</td>
			<td><?php echo date('jS M Y', strtotime($ticket['Ticket']['due'])); ?>&nbsp;</td>
			<td><?php echo '<span class="state '.$ticket['State']['name'].'">'.$ticket['State']['name'].'</span>'; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'tickets', 'action' => 'edit', $ticket['Ticket']['id'])); ?>
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
