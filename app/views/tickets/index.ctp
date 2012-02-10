<div class="tickets index">
	<h2><?php __('Tickets');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('assigned_to');?></th>
			<th><?php echo $this->Paginator->sort('customer_id');?></th>
			<th><?php echo $this->Paginator->sort('subject');?></th>
			<th><?php echo $this->Paginator->sort('balance_due');?></th>
			<th><?php echo $this->Paginator->sort('due');?></th>
			<th><?php echo $this->Paginator->sort('state_id');?></th>
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
	<tr<?php echo $class; ?>>
		<td><?php echo $ticket['Ticket']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ticket['AssignedTo']['username'], array('controller' => 'users', 'action' => 'view', $ticket['AssignedTo']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($ticket['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $ticket['Customer']['id'])); ?>
		</td>
		<td class="subject"><?php echo $ticket['Ticket']['subject']; ?>&nbsp;</td>
		<td class="balanceDue">
			<?php
				setlocale(LC_MONETARY, 'en_GB');
				echo '&pound;'.number_format($ticket['Ticket']['balance_due'], 2);
			?>
		</td>
		<td>
			<?php
				if ($ticket['State']['name'] == 'Resolved') {
					echo '<span class="resolvedDue">'.date('jS M Y', strtotime($ticket['Ticket']['due'])).'</span>';
				} else {
					echo date('jS M Y', strtotime($ticket['Ticket']['due']));
				}
			?>
		</td>
		<td>
			<?php echo '<span class="state '.$ticket['State']['name'].'">'.$ticket['State']['name'].'</span>'; ?>
			<?php
				if ($ticket['State']['name'] !== 'Resolved') {
					if (strtotime(date('Y-m-d')) == strtotime($ticket['Ticket']['due'])) {
						echo '<span class="state Overdue">Due Today</span>';
					}
					if (strtotime(date('Y-m-d')) > strtotime($ticket['Ticket']['due'])) {
						echo '<span class="state Overdue">Overdue!</span>';
					}
				}
			?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'edit', $ticket['Ticket']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('+ New Ticket', true), array('action' => 'add')); ?></li>
	</ul>
</div>