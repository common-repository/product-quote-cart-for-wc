<?php
$gmpqcw_cart_enable_setting = get_option( 'gmpqcw_cart_enable_setting' );


$gmpqcw_cart_button_label = get_option( 'gmpqcw_cart_button_label' );
$gmpqcw_cart_display = get_option( 'gmpqcw_cart_display' );
$gmpqcw_cart_page = get_option( 'gmpqcw_cart_page' );
?>
<form method="post" action="options.php">
	<?php settings_fields( 'gmpqcw_cart_options_group' ); ?>
	<table class="form-table">
		<tr valign="top">
            <th scope="row">
               <label for="gmpqcw_cart_enable_setting"><?php _e('Enable', 'gmpqcw'); ?></label>
            </th>
            <td>
               <input class="regular-text" type="checkbox" id="gmpqcw_cart_enable_setting" <?php echo (($gmpqcw_cart_enable_setting=='yes')?'checked':'') ; ?> name="gmpqcw_cart_enable_setting" value="yes" />
            </td>
         </tr>
	
	
	
		
		<tr valign="top">
			<th scope="row">
				<label><?php _e("Enquiry Cart Button Label", 'gmpqcw'); ?></label>
			</th>
			<td>
				<input class="regular-text" type="text" name="gmpqcw_cart_button_label" value="<?php echo $gmpqcw_cart_button_label; ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label><?php _e('Enquiry Cart Display Page', 'gmpqcw'); ?></label></th>
			<td>
				<input type="radio" name="gmpqcw_cart_display" <?php echo ($gmpqcw_cart_display=='all')?'checked':''; ?> value="all"><?php _e('Shop and Single Product Page', 'gmpqcw'); ?><br/>
				<input type="radio" name="gmpqcw_cart_display" <?php echo ($gmpqcw_cart_display=='single')?'checked':''; ?> value="single"><?php _e('Single Product Page', 'gmpqcw'); ?><br/>
				<input type="radio" name="gmpqcw_cart_display" <?php echo ($gmpqcw_cart_display=='custom')?'checked':''; ?> value="custom"><?php _e('Custom Location', 'gmwqp'); ?><br>
				<strong><em>Note : Custom Location for you need to use shortcode</em></strong>
			</td>
		</tr>
		<tr>
			<th scope="row"><label>ShortCode</label></th>
			<td>
				<code>[gmpqcw_enquiry_single_product]</code>  or <code>[gmpqcw_enquiry_single_product id='{product_id}']</code>
			</td>
		</tr>
		<tr>
			<th scope="row"><label><?php _e('Select Enquiry Cart Page', 'gmpqcw'); ?></label></th>
			<td>
				<?php

				$list_cart_page = get_posts( array(
							        'posts_per_page' => -1,
							        'post_type'  => 'page',
							    ) );
				?>
				<select name="gmpqcw_cart_page" required>
					<option value=""><?php _e("Select Enquiry Page", 'gmpqcw'); ?></option>
					<?php
					foreach ($list_cart_page as $keylist_cart_page => $valuelist_cart_page) {
						echo '<option  '.(($gmpqcw_cart_page==$valuelist_cart_page->ID)?'selected':'').' value="'.$valuelist_cart_page->ID.'">'.$valuelist_cart_page->post_title.'</option>';
					}
					?>
				</select>
				
				<p class="description">
					<?php _e('You Must be Create Page for Cart Showing and for Enquiry Cart page in insert <strong>[gm_woo_enquiry_cart]</strong> shortcode so it will be work', 'gmpqcw'); ?>
		
				</p>
			</td>
		</tr>

		

		
		
	</table>

	
	<?php  submit_button(); ?>
</form>