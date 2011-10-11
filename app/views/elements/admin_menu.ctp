<ul id="adminMenu">
	<li>
		<?php echo $this->Html->link('Tickets', array('controller' => 'tickets', 'action' => 'index')); ?>
	</li>
	<li>
		<?php echo $this->Html->link('Customers', array('controller' => 'customers', 'action' => 'index')); ?>
	</li>
	<li>
		<?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?>
	</li>
</ul>