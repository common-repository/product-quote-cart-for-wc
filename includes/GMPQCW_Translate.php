<?php

?>
<form method="post" action="options.php">
	<?php settings_fields( 'gmpqcw_translate_options_group' ); ?>
	<table class="form-table">
		<tr valign="top">
			<th scope="row">
				<label>ENQUIRY!</label>
			</th>
			<td>
				<input class="regular-text" type="text" name="gmpqcw_button_label" value="<?php echo get_option('gmpqcw_button_label'); ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label>Product Enquiry</label>
			</th>
			<td>
				<input class="regular-text" type="text" name="gmpqcw_form_title" value="<?php echo get_option('gmpqcw_form_title'); ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label>Please Enter</label>
			</th>
			<td>
				<input class="regular-text" type="text" name="gmpqcw_form_required" value="<?php echo get_option('gmpqcw_form_required'); ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label>Your Message Successfully Sent!</label>
			</th>
			<td>
				<input class="regular-text" type="text" name="gmpqcw_email_sucesemsg" value="<?php echo get_option('gmpqcw_email_sucesemsg'); ?>" />
			</td>
		</tr>
	</table>
	<?php  submit_button(); ?>
</form>