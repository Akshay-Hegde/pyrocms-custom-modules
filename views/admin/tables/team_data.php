<?php echo form_open('admin/team/setOrder') ?>
	<?php if($records): ?>	
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Image</th>
				<th>Position</th>
				<th colspan="3"></th>
			</tr>
		</thead>

			<?php foreach( $records as $key => $record ){ ?>
				<tr>
					<td style="width:5%"><?php echo $key+1; ?></td>
					<td style="width:25%"><?php echo $record->name; ?></td>
					<td style="width:25%">
						<img src="<?=base_url()?>/files/thumb/<?=$record->image;?>/100/200" >
					</td>
					<td style="width:15%">
						<div class="input" style="width:100%"><?php echo form_input("position[$record->id]", set_value("position[$record->id]", $record->position), 'style="width:50%"'); ?></div>
					</td>
						
					<?php echo form_hidden("id[$record->id]",set_value("id[$record->id]",$record->id)); ?>
						<td class="actions">
							<?php echo
								anchor('company#team', lang('team:view'), 'class="button" target="_blank"').' '.
								anchor('admin/team/edit/'.$record->id, lang('team:edit'), 'class="button"').' '.
								anchor('admin/team/delete/'.$record->id,	lang('team:delete'), array('class'=>'button')); ?>
						</td>
				</tr>
			<?php } ?>
		</table>
	<input type="submit" style="margin-left:56%;" value="Set Order" class="button" id="set-order">
<?php echo form_close(); ?>
<?php else: ?>
		<div class="no_data"><?php echo lang('team:currently_no_records'); ?></div>
<?php endif;?>
