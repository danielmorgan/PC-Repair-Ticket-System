<div class="backups view">
	<h2><?php echo $filename;?></h2>
	<pre><?php echo $file; ?></pre>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('< List Backups', true), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Restore', true), array('action' => 'restore', $filename), null, sprintf(__('Are you sure you want to restore %s?', true), $filename)); ?></li>
	</ul>
</div>