<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
		<?php __('| PC Repair Ticket System'); ?>
	</title>
	<script type="text/javascript" src="https://www.google.com/jsapi?key=ABQIAAAA3g7P-kkUbLNHDkesUsfErxRUcGRmHVUSsqSZ5X8ZIRGotTybUhS-WlR8kGTQcbtY6AggHdXzY9HHUg"></script>
	<script type="text/javascript">
		google.load("jquery", "1.6.1");
	</script>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('datePicker');
		echo $this->Javascript->link('jquery.autocomplete.js');
		echo $this->Javascript->link('date.js');
		echo $this->Javascript->link('jquery.datePicker.js');
		echo $this->Javascript->link('cake.datePicker.js');
		echo $this->Javascript->link('functions.js');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<a href="/" id="logo"><h1><?php __('PC Repair Ticket System'); ?></h1></a>
		</div>
		<div id="nav">
			<?php echo $this->element('admin_menu'); ?>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>