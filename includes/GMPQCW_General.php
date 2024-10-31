<?php
$gmpqcw_usershow = get_option( 'gmpqcw_usershow' );
$gmpqcw_hide_add_to_cart = get_option( 'gmpqcw_hide_add_to_cart' );
$gmpqcw_label_show = get_option( 'gmpqcw_label_show' );
$gmpqcw_remove_price = get_option( 'gmpqcw_remove_price' );
$gmpqcw_show_product_outofstock = get_option( 'gmpqcw_show_product_outofstock' );
$gmpqcw_enquiry_btn_bg_color = get_option( 'gmpqcw_enquiry_btn_bg_color' );
$gmpqcw_enquiry_btn_text_color = get_option( 'gmpqcw_enquiry_btn_text_color' );
$gmpqcw_enquiry_btn_bg_hover_color = get_option( 'gmpqcw_enquiry_btn_bg_hover_color' );
$gmpqcw_enquiry_btn_text_hover_color = get_option( 'gmpqcw_enquiry_btn_text_hover_color' );
$gmpqcw_redirect_form_sub = get_option( 'gmpqcw_redirect_form_sub' );
$gmpqcw_redirect_form_sub_page = get_option( 'gmpqcw_redirect_form_sub_page' );
$gmpqcw_disable_cart_checkout_page = get_option( 'gmpqcw_disable_cart_checkout_page' );
$gmpqcw_redirect_disable_cart_checkout_page = get_option( 'gmpqcw_redirect_disable_cart_checkout_page' );

?>
<form method="post" action="options.php">
	<?php settings_fields( 'gmpqcw_general_options_group' ); ?>
  <div class="metabox-holder">
    <div class="postbox">
      <div class="postbox-header">
        <h3 class="hndle">Setting</h3>
      </div>
      <div class="inside">
        <table class="form-table">
          <tr>
            <th scope="row"><label><?php _e('Users Show', 'gmpqcw'); ?></label></th>
            <td>
              <input type="radio" name="gmpqcw_usershow" <?php echo ($gmpqcw_usershow=='all')?'checked':''; ?> value="all"><?php _e('All Users', 'gmpqcw'); ?>
              <input type="radio" name="gmpqcw_usershow" <?php echo ($gmpqcw_usershow=='logged_user')?'checked':''; ?> value="logged_user"><?php _e('Only Logged in Users', 'gmpqcw'); ?>
              <input type="radio" name="gmpqcw_usershow" <?php echo ($gmpqcw_usershow=='logged_out')?'checked':''; ?> value="logged_out"><?php _e('Only Logged out Users', 'gmpqcw'); ?>
            </td>
          </tr>
           <tr valign="top">
            <th scope="row">
               <label for="gmpqcw_show_product_outofstock"><?php _e('Show Enquiry Button When Product is out of stock', 'gmpqcw'); ?></label>
            </th>
            <td> 
               <input class="regular-text" type="checkbox" id="gmpqcw_show_product_outofstock" <?php echo (($gmpqcw_show_product_outofstock=='yes')?'checked':'') ; ?> name="gmpqcw_show_product_outofstock" value="yes" />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
               <label for="gmpqcw_remove_price"><?php _e('Remove Price From Product', 'gmpqcw'); ?></label>
            </th>
            <td> 
               <input class="regular-text" type="checkbox" id="gmpqcw_remove_price" <?php echo (($gmpqcw_remove_price=='yes')?'checked':'') ; ?> name="gmpqcw_remove_price" value="yes" />
            </td>
        </tr>

       
      <tr valign="top">
            <th scope="row">
               <label for="gmpqcw_hide_add_to_cart"><?php _e('Hide Add to Cart Button', 'gmpqcw'); ?></label>
            </th>
            <td> 
               <input class="regular-text" type="checkbox" id="gmpqcw_hide_add_to_cart" <?php echo (($gmpqcw_hide_add_to_cart=='yes')?'checked':'') ; ?> name="gmpqcw_hide_add_to_cart" value="yes" />
            </td>
        </tr>

        </table>
      </div>
    </div>
  </div>
  <div class="metabox-holder">
    <div class="postbox">
      <div class="postbox-header">
        <h3 class="hndle">Form Setting</h3>
      </div>
      <div class="inside">
        <table class="form-table">
          <tr>
            <th scope="row"><label><?php _e('Label / Placeholder Display', 'gmpqcw'); ?></label></th>
            <td>
              <input type="radio" name="gmpqcw_label_show" <?php echo ($gmpqcw_label_show=='show_label')?'checked':''; ?> value="show_label"><?php _e('Show Label', 'gmpqcw'); ?>
              <input type="radio" name="gmpqcw_label_show" <?php echo ($gmpqcw_label_show=='show_placeholder')?'checked':''; ?> value="show_placeholder"><?php _e('Show Placeholder', 'gmpqcw'); ?>
            </td>
          </tr>
          <tr>
              <th scope="row"><label><?php _e('Button Background Color', 'gmpqcw'); ?></label></th>
              <td>
                 <input type="text" class="gmpqcw-color-field" name="gmpqcw_enquiry_btn_bg_color" value="<?php echo $gmpqcw_enquiry_btn_bg_color; ?>">
              </td>
          </tr>
          <tr>
              <th scope="row"><label><?php _e('Button Text Color', 'gmpqcw'); ?></label></th>
              <td>
                 <input type="text" class="gmpqcw-color-field" name="gmpqcw_enquiry_btn_text_color" value="<?php echo $gmpqcw_enquiry_btn_text_color; ?>">
              </td>
          </tr>
          <tr>
              <th scope="row"><label><?php _e('Button Background Hover Color', 'gmpqcw'); ?></label></th>
              <td>
                 <input type="text" class="gmpqcw-color-field" name="gmpqcw_enquiry_btn_bg_hover_color" value="<?php echo $gmpqcw_enquiry_btn_bg_hover_color; ?>">
              </td>
          </tr>
          <tr>
              <th scope="row"><label><?php _e('Button Text Hover Color', 'gmpqcw'); ?></label></th>
              <td>
                 <input type="text" class="gmpqcw-color-field" name="gmpqcw_enquiry_btn_text_hover_color" value="<?php echo $gmpqcw_enquiry_btn_text_hover_color; ?>">
              </td>
          </tr>

        </table>
      </div>
    </div>
  </div>

  <div class="metabox-holder">
    <div class="postbox">
      <div class="postbox-header">
        <h3 class="hndle">Redirection Setting</h3>
      </div>
      <div class="inside">
        <table class="form-table">
               

<tr>
            <th scope="row"><label><?php _e('Redirect after Enquiry form Submission', 'gmpqcw'); ?></label></th>
            <td>
              <input class="regular-text sourfocheck" target="gmpqcw_redirect_form_sub_page" type="checkbox" id="gmpqcw_redirect_form_sub" <?php echo (($gmpqcw_redirect_form_sub=='yes')?'checked':'') ; ?> name="gmpqcw_redirect_form_sub" value="yes" />
             
            </td>
          </tr>


    <tr style='<?php echo (($gmpqcw_redirect_form_sub!='yes')?'display:none;':'') ; ?>' class="gmpqcw_redirect_form_sub_page">
          <th scope="row"><label><?php _e('Redirect Page', 'gmpqcw'); ?></label></th>
          <td>
            <?php
      $list_cart_page = get_posts( array(
                          'posts_per_page' => -1,
                          'post_type'  => 'page',
                      ) );
            ?>
            <select name="gmpqcw_redirect_form_sub_page">
             <?php
              foreach ($list_cart_page as $keylist_cart_page => $valuelist_cart_page) {
                echo '<option  '.(($gmpqcw_redirect_form_sub_page==$valuelist_cart_page->ID)?'selected':'').' value="'.$valuelist_cart_page->ID.'">'.$valuelist_cart_page->post_title.'</option>';
              }
              ?>
            </select>
            <p class="description">
              <?php _e('Select page where user will be redirected for form submission.', 'gmpqcw'); ?>
            </p>
          </td>
        </tr>



          <tr>
            <th scope="row"><label><?php _e('Disable Woocommerce Cart and Checkout Page?', 'gmpqcw'); ?></label></th>
            <td>
              <input class="regular-text sourfocheck"  target="gmpqcw_redirect_disable_cart_checkout_page"  type="checkbox" id="gmpqcw_disable_cart_checkout_page" <?php echo (($gmpqcw_disable_cart_checkout_page=='yes')?'checked':'') ; ?> name="gmpqcw_disable_cart_checkout_page" value="yes" />
             
            </td>
          </tr>


          <tr style='<?php echo (($gmpqcw_disable_cart_checkout_page!='yes')?'display:none;':'') ; ?>'  class="gmpqcw_redirect_disable_cart_checkout_page">
              <th scope="row"><label><?php _e('Redirect Page', 'gmpqcw'); ?></label></th>
              <td>
                <?php
                $list_cart_page = get_posts( array(
                              'posts_per_page' => -1,
                              'post_type'  => 'page',
                          ) );
                ?>
                <select name="gmpqcw_redirect_disable_cart_checkout_page">
                 <?php
                  foreach ($list_cart_page as $keylist_cart_page => $valuelist_cart_page) {
                    echo '<option  '.(($gmpqcw_redirect_disable_cart_checkout_page==$valuelist_cart_page->ID)?'selected':'').' value="'.$valuelist_cart_page->ID.'">'.$valuelist_cart_page->post_title.'</option>';
                  }
                  ?>
                </select>
                <p class="description">
                  <?php _e('Select page where user will be redirected for disable cart page.', 'gmpqcw'); ?>
                </p>
              </td>
            </tr>
            
          </tr>
        </table>
      </div>
    </div>
  </div>
	<?php  submit_button(); ?>
</form>