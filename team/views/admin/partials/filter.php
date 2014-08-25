<fieldset id="filters">
	<legend><?php echo lang('global:filters') ?></legend>
		<?php echo form_open('','', array('f_module' => $module_details['slug'])) ?>
				<b>Name</b>: <?php echo form_input('f_name','','style="width: 15%;"') ?>
				<?php echo anchor(current_url() . '#', lang('team:cancel'), 'class="cancel"'); ?>
		<?php echo form_close() ?>
</fieldset>