<div class="backups index">
	<h2><?php __('Database Backups');?></h2>
	<p style="margin: -10px 0 15px;">Backups run via cron job once a day, but you can also create backups manually with the button to the left.</p>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Backup</th>
			<th>Created</th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($backups as $backup):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
		<tr data-href="<?php echo $this->Html->url(array("action" => "view", $backup)); ?>"<?php echo $class;?>>
			<td><?php echo $backup; ?></td>
			<td><?php echo $this->Time->niceShort(substr($backup, 7, -4)); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('action' => 'view', $backup)); ?>
				<?php echo $this->Html->link(__('Restore', true), array('action' => 'restore', $backup), null, sprintf(__('Are you sure you want to restore %s?', true), $backup)); ?>
				<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $backup), null, sprintf(__('Are you sure you want to delete %s?', true), $backup)); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Backup Database Now', true), array('action' => 'save')); ?></li>
	</ul>
</div>
