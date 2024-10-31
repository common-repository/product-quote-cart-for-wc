<?php
$gmpqcw_include_exclude = get_option( 'gmpqcw_include_exclude' );
$gmpqcw_include_category = get_option( 'gmpqcw_include_category',array());
if(empty($gmpqcw_include_category)){
  $gmpqcw_include_category = array();
}
$gmpqcw_exclude_category = get_option( 'gmpqcw_exclude_category',array());
if(empty($gmpqcw_exclude_category)){
  $gmpqcw_exclude_category = array();
}

?>
<form method="post" action="options.php">
	<?php settings_fields( 'gmpqcw_exclude_options_group' ); ?>
	<table class="form-table">
    <tr>
        <th scope="row"><label><?php _e('Include Exclude Base On Category', 'gmpqcw'); ?></label></th>
        <td>
          <input type="radio" name="gmpqcw_include_exclude" <?php echo ($gmpqcw_include_exclude=='all')?'checked':''; ?> value="all" target="" class="includexdfocheck">All
          <input type="radio" name="gmpqcw_include_exclude" <?php echo ($gmpqcw_include_exclude=='include')?'checked':''; ?> value="include" target="gmpqcw_include_div" class="includexdfocheck">Include
          <input type="radio" name="gmpqcw_include_exclude" <?php echo ($gmpqcw_include_exclude=='exclude')?'checked':''; ?> value="exclude" target="gmpqcw_exclude_div" class="includexdfocheck">Exclude
        </td>
      </tr>
       <tr valign="top" class="gmpqcw_include_div"  style='<?php echo (($gmpqcw_include_exclude=='include')?'':'display:none;') ; ?>' >
            <th scope="row">
               <label for="gmpqcw_include_category"><?php _e('Include From Category', 'gmpqcw'); ?></label>
            </th>
            <td> 
              <?php
              $terms_cat = get_terms( 'product_cat', array(
                        'hide_empty' => false,
                    ) );

             
              ?>
               <select name="gmpqcw_include_category[]" multiple  class="gmpqcw-select" style="min-width: 200px;">
                 <?php
                 foreach ($terms_cat as $key_terms_cat => $value_terms_cat) {
                   echo '<option value="'.$value_terms_cat->term_id.'" '.((in_array($value_terms_cat->term_id, $gmpqcw_include_category))?'selected':'').'>'.$value_terms_cat->name.'</option>';
                 }
                 ?>
                </select>
            </td>
        </tr>
        <tr valign="top"class="gmpqcw_exclude_div"  style='<?php echo (($gmpqcw_include_exclude=='exclude')?'':'display:none;') ; ?>' >
            <th scope="row">
               <label for="gmpqcw_exclude_category"><?php _e('Exclude From Category', 'gmpqcw'); ?></label>
            </th>
            <td> 
              <?php
              $terms_cat = get_terms( 'product_cat', array(
                        'hide_empty' => false,
                    ) );

             
              ?>
               <select name="gmpqcw_exclude_category[]" multiple  class="gmpqcw-select" style="min-width: 200px;">
                 <?php
                 foreach ($terms_cat as $key_terms_cat => $value_terms_cat) {
                   echo '<option value="'.$value_terms_cat->term_id.'" '.((in_array($value_terms_cat->term_id, $gmpqcw_exclude_category))?'selected':'').'>'.$value_terms_cat->name.'</option>';
                 }
                 ?>
                </select>
            </td>
        </tr>
	</table>
	<?php  submit_button(); ?>
</form>