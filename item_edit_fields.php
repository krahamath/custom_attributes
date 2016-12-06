<?php
if ( !defined('ABS_PATH') ) { 
	exit('ABS_PATH is not loaded. Direct access is not allowed.');
}
?>

<?php
foreach ($fields as $field) {
	$field_id = $field['pk_i_id'];
	$label = $field['s_label'];
	$type = $field['s_type'];
	$name = 'field_' . $field['pk_i_id'];
	$value = Attributes::newInstance()->getValue($item_id, $field_id); 
	$required = $field['b_required'];
	// Build classes
	if ($required) {
		$class = 'required';
	} else {
		$class = '';
	}
	if ($type == 'date') {
		$class .= ' edit_date';
	}
	if (!empty($class)) {
		$class = " class='" . trim($class) . "'";
	}
	// Get saved value from sesssion
	if( Session::newInstance()->_getForm($name) != '') {
		$value = Session::newInstance()->_getForm($name);
	}	
?>

<input type='hidden' name='fields[]' value='<?php echo $field_id; ?>' />
<div class="form-group">
<?php if ($type == 'checkbox') {  ?>
	<label class='edit_label control-label' for='<?php echo $name; ?>'><?php echo $label; ?></label>
	<div class="control">
		<?php $checked = ($value == 'checked') ? " checked='checked'" : ''; ?>
		<label>
			<input id='<?php echo $name; ?>' class='edit_checkbox' type='checkbox' name='<?php echo $name; ?>' value='checked'<?php echo $checked; ?> />
			<?php _e('Tick for "Yes"', CA_PLUGIN_NAME); ?>
		</label>
	</div>
<?php } elseif ($type == 'date') { ?>
	<label class='edit_label control-label' for='<?php echo $name; ?>'><?php echo $label; ?></label>
	<div class="control">
		<input id='<?php echo $name; ?>'<?php echo $class; ?> type='text' name='<?php echo $name; ?>' value='<?php echo $value; ?>' />
	</div>
<?php } elseif ($type == 'radio') { ?>
	<label class='edit_label control-label' for='<?php echo $name; ?>'><?php echo $label; ?></label>
	<div class="control">
		<?php $this->radio_buttons($field_id, $name, $value, $required); ?>	
	</div>
<?php } elseif ($type == 'select') { ?>
	<label class='edit_label control-label' for='<?php echo $name; ?>'><?php echo $label; ?></label>
	<div class="control">
		<select id='<?php echo $name; ?>'<?php echo $class; ?> name='<?php echo $name; ?>'>
			<?php $this->select_options($field_id, $value); ?>
		</select>
	</div>
<?php } elseif ($type == 'text') { ?>
	<label class='edit_label control-label' for='<?php echo $name; ?>'><?php echo $label; ?></label>
	<div class="control">
		<input id='<?php echo $name; ?>'<?php echo $class; ?> type='text' name='<?php echo $name; ?>' value='<?php echo $value; ?>' />
	</div>
<?php } elseif ($type == 'textarea') {  ?>
	<label class='edit_label control-label' for='<?php echo $name; ?>'><?php echo $label; ?></label>
	<div class="control">
		<textarea id='<?php echo $name; ?>'<?php echo $class; ?> name='<?php echo $name; ?>'><?php echo $value; ?></textarea>
	</div>
<?php } ?>
</div>

<?php } ?>

<?php //END
