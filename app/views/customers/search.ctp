<div class="customers index">
	<h2><?php __('Search Results:');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('phone');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($results as $customer):
	?>
	<tr data-href="<?php echo $this->Html->url(array("action" => "view", $customer['Customer']['id'])); ?>" class="searchResultCustomer">
		<td><?php echo $customer['Customer']['id']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($customer['Customer']['name'], array('action' => 'view', $customer['Customer']['id'])); ?>&nbsp;</td>
		<td><?php echo $customer['Customer']['phone']; ?>&nbsp;</td>
		<td><?php echo $customer['Customer']['email']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $customer['Customer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $customer['Customer']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $customer['Customer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $customer['Customer']['id'])); ?>
		</td>
	</tr>

	<tr>
		<td colspan="5">
			<table class="searchResultTickets">

				<?php
				foreach ($customer['Ticket'] as $ticket):
				?>
				<tr data-href="<?php echo $this->Html->url(array('controller' => 'tickets', 'action' => 'edit', $ticket['id'])); ?>">
					<td class="subject"><?php echo $ticket['subject']; ?>&nbsp;</td>
					<td><?php echo $ticket['notes']; ?>&nbsp;</td>
					<td class="balanceDue">
						<?php
							setlocale(LC_MONETARY, 'en_GB');
							$amount_due = $ticket['amount_owed'] - $ticket['amount_paid'];
							echo '&pound;'.number_format($amount_due, 2);
						?>
					</td>
					<td class="actions">
						<?php echo $this->Html->link(__('View', true), array('controller' => 'tickets', 'action' => 'edit', $ticket['id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>

			</table><br />
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
		<li><?php echo $this->Html->link(__('+ New Customer', true), array('action' => 'add')); ?></li>
	</ul>
</div>
