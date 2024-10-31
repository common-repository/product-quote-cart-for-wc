<?php
$gmpqcw_email_body = get_option( 'gmpqcw_email_body' );
$gmpqcw_field_customizer_field = get_option( 'gmpqcw_field_customizer_field' );
$gmpqcw_email_sucesemsg = get_option( 'gmpqcw_email_sucesemsg' );
$gmpqcw_send_enquiry_email_cutomer = get_option( 'gmpqcw_send_enquiry_email_cutomer' );
?>
<form method="post" action="options.php">
  
  
  <?php settings_fields( 'gmpqcw_email_customizer_group' ); ?>
  <table class="form-table">
    <tr valign="top">
      <th scope="row">
        <label><?php _e("Recipient's Email", 'gmpqcw'); ?></label>
      </th>
      <td>
        <input class="regular-text" type="text" name="gmpqcw_reci_email" value="<?php echo get_option('gmpqcw_reci_email'); ?>" />
      </td>
    </tr>
    <tr valign="top">
      <th scope="row">
        <label><?php _e("Email subject", 'gmpqcw'); ?></label>
      </th>
      <td>
        <input class="regular-text" type="text" name="gmpqcw_email_sub" value="<?php echo get_option('gmpqcw_email_sub'); ?>" />
      </td>
    </tr>
    <tr valign="top">
      <th scope="row">
        <label for="gmpqcw_send_enquiry_email_cutomer"><?php _e('Send Enquiry Email to Customer As Well', 'gmpqcw'); ?></label>
      </th>
      <td>
        <input class="regular-text" type="checkbox" id="gmpqcw_send_enquiry_email_cutomer" <?php echo (($gmpqcw_send_enquiry_email_cutomer=='yes')?'checked':'') ; ?> name="gmpqcw_send_enquiry_email_cutomer" value="yes" />
      </td>
    </tr>
    <tr valign="top">
      <th scope="row">
        <label><?php _e("Customer Email Subject", 'gmpqcw'); ?></label>
      </th>
      <td>
        <input class="regular-text" type="text" name="gmpqcw_customer_email_subject" value="<?php echo get_option('gmpqcw_customer_email_subject'); ?>" />
      </td>
    </tr>
    <tr valign="top">
      <th scope="row">
        <label><?php _e('Email Body', 'gmpqcw'); ?></label>
      </th>
      <td>
        
        <p style="word-break: break-word;">
          <?php
          foreach ($gmpqcw_field_customizer_field as $keygmpqcw_field_customizer_field => $valuegmpqcw_field_customizer_field) {
          //if($keygmpqcw_field_customizer_field!='captcha'){
          echo '<code>['.$keygmpqcw_field_customizer_field.']</code>&nbsp;&nbsp;';
          //}
          
          }
          ?>
          <code>[product]</code>
        </p>
        <?php
        $settings  = array(
        'media_buttons' => false ,
        'textarea_rows' => 15,
        'quicktags'     => true
        );
        wp_editor( $gmpqcw_email_body,'gmpqcw_email_body',$settings);?>
        
      </td>
    </tr>
    <tr valign="top">
      <th scope="row">
        <label><?php _e('Form Success Message', 'gmpqcw'); ?></label>
      </th>
      <td>
        <input class="regular-text"  type="text" required name="gmpqcw_email_sucesemsg" value="<?php echo $gmpqcw_email_sucesemsg;?>" />
      </td>
    </tr>
  </table>
  <?php  submit_button(); ?>
</form>