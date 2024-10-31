<?php

$gmpqcw_field_customizer_enble = get_option( 'gmpqcw_field_customizer_enble' );
$gmpqcw_field_customizer_required = get_option( 'gmpqcw_field_customizer_required' );
$gmpqcw_field_customizer_field = get_option( 'gmpqcw_field_customizer_field' );
$gmpqcw_field_customizer_type = get_option( 'gmpqcw_field_customizer_type' );
$gmpqcw_field_customizer_order = get_option( 'gmpqcw_field_customizer_order' );
$gmpqcw_field_customizer_option = get_option( 'gmpqcw_field_customizer_option' );
$gmpqcw_content_beforeform = get_option( 'gmpqcw_content_beforeform' );
$gmpqcw_content_afterform = get_option( 'gmpqcw_content_afterform' );
/*echo "<pre>";
    print_r($gmpqcw_field_customizer_enble);
    print_r($gmpqcw_field_customizer_required);
    print_r($gmpqcw_field_customizer_field);
    print_r($gmpqcw_field_customizer_type);
    print_r($gmpqcw_field_customizer_option);
echo "</pre>";*/
?>
<form method="post" action="options.php">
  
  
  <?php settings_fields( 'gmpqcw_form_customizer_group' ); ?>


  <div class="fomradbuso">
    
    <a href="#" class="button button-primary addnew_customizer_form" style="margin-top:20px;margin-bottom: 20px;"><?php _e('Add New Field', 'gmpqcw'); ?></a>
  </div>

  <table class="widefat">
    <tr valign="top">
      
      <th><?php _e('Enable / Disable', 'gmpqcw'); ?></th>
      <th><?php _e('Required', 'gmpqcw'); ?></th>
      <th><?php _e('Field Label', 'gmpqcw'); ?></th>
      <th><?php _e('Field Order Number', 'gmpqcw'); ?></th>
      <th><?php _e('Field Type', 'gmpqcw'); ?></th>
      <th><?php _e('Field Options', 'gmpqcw'); ?></th>
      <th><?php _e('Action', 'gmpqcw'); ?></th>
    </tr>
   
    <?php
    $looparrm = $gmpqcw_field_customizer_field;
    $x=1;
    if(!empty($looparrm)){
    foreach ($looparrm as $keylooparrm => $valuelooparrm) {
    ?>
    <tr valign="top">
      
      <td>
        <input class="regular-text" type="checkbox" <?php if($x==1 || $x==2){echo 'readonly';} ?>  <?php echo (isset($gmpqcw_field_customizer_enble[$keylooparrm]) && $gmpqcw_field_customizer_enble[$keylooparrm]=='yes')?'checked':'';?>  name="gmpqcw_field_customizer_enble[<?php echo $keylooparrm;?>]" value="yes"   />
      </td>
      <td>
        <input class="regular-text" type="checkbox"  <?php if($x==1 || $x==2){echo 'readonly';} ?>   <?php echo (isset($gmpqcw_field_customizer_required[$keylooparrm]) && $gmpqcw_field_customizer_required[$keylooparrm]=='yes')?'checked':'';?> name="gmpqcw_field_customizer_required[<?php echo $keylooparrm;?>]" value="yes"   />
      </td>
      <td>
        <input class="regular-text"  type="text" required name="gmpqcw_field_customizer_field[<?php echo $keylooparrm;?>]" value="<?php echo $valuelooparrm;?>" />
        <input  type="hidden" name="gmpqcw_field_customizer_type[<?php echo $keylooparrm;?>]" value="<?php echo $gmpqcw_field_customizer_type[$keylooparrm];?>" />
      </td>
      <td>
        <input class="regular-text" style="width:60px;"  type="number" required name="gmpqcw_field_customizer_order[<?php echo $keylooparrm;?>]" value="<?php echo $gmpqcw_field_customizer_order[$keylooparrm];?>" />
      </td>
      <td>
        <?php echo $gmpqcw_field_customizer_type[$keylooparrm];?>
      </td>
        <td>
          <?php
         
          $fromtype = array("select", "radio", "multiselect", "checkbox");
          if (in_array( $gmpqcw_field_customizer_type[$keylooparrm], $fromtype)){
          ?>
          <textarea class="regular-text" style='max-width:150px;' placeholder="Option 1&#10;Option 2"   name="gmpqcw_field_customizer_option[<?php echo $keylooparrm;?>]"><?php echo (isset($gmpqcw_field_customizer_option[$keylooparrm]))?$gmpqcw_field_customizer_option[$keylooparrm]:'';?></textarea>
          <?php
          }
          ?>
          
        </td>
        <td>
        <?php
        if($x>6){
        ?>
        <a href="<?php echo admin_url( 'admin.php?action=delete_keyif&key='.$keylooparrm);?>" class="button">Delete Field</a>
        <?php
        }
        ?>
      </td>
    </tr>
    <?php
    $x++;
    }
    }
    ?>
  </table>
  <table class="form-table">
    <tr valign="top">
        <th scope="row">
           <label><?php _e('Content Before Enquiry From', 'gmpqcw'); ?></label>
        </th>
        <td>
           <?php
           wp_editor( $gmpqcw_content_beforeform,'gmpqcw_content_beforeform',array('textarea_rows' => 4));
           ?>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
           <label><?php _e('Content After Enquiry From', 'gmpqcw'); ?></label>
        </th>
        <td>
           <?php
           wp_editor( $gmpqcw_content_afterform,'gmpqcw_content_afterform',array('textarea_rows' => 4));
           ?>
        </td>
    </tr>
  </table>
  <?php  submit_button(); ?>
</form>
<div class="showpopmain" style="display: none;">
  <div class="popupinner">
    <div class="postbox">
      <a class="closeicond" href="#"><span class="dashicons dashicons-no"></span></a>
      <div class="inside">
        <form action="#" method="post" id="wp_job_custom_form">
          
          <h3><?php _e('Custom Field Add', 'gmpqcw'); ?></h3>
          <table class="form-table">
            
            <tr>
              <th scope="row"><label>Field Type</label></th>
              <td>
                <select name="gmpqcw_field_customizer_type" class="field_type_gmpqcw" >
                  <?php
                  foreach ($this->fieldset_arr_gm as $fieldset_arrk => $fieldset_arrv) {
                  echo '<option value="'.$fieldset_arrk.'" >'.$fieldset_arrv.'</option>';
                  }
                  ?>
                  
                </select>
              </td>
            </tr>
            <tr>
              <th scope="row"><label>Field Name</label></th>
              <td>
                <input type="text" required class="regular-text" name="gmpqcw_field_customizer_field">
              </td>
            </tr>

            <tr class="gmpqcw_option" style="display: none;">
              <th scope="row"><label>Field Option</label></th>
              <td>
                <textarea  class="regular-text textheighs" name="gmpqcw_field_customizer_option" placeholder="Option 1&#10;Option 2"></textarea>
                <p class="description">Per Line add one Option</p>
              </td>
            </tr>
            <tr>
              <th scope="row"><label>Field Required</label></th>
              <td>
                <input type="checkbox"  class="regular-text" name="field_required_gmpqcw" value="yes">
              </td>
            </tr>
          </table>
          
          <p class="submit">
            <input type="hidden" name="action" value="add_new_field_gmpqcw">
            <input type="submit" name="submit"  class="button button-primary" value="Save">
          </p>
        </form>
      </div>
    </div>
    
  </div>
  <style type="text/css">
input[type="checkbox"][readonly] {
  pointer-events: none;
    opacity: 0.5;
}
  </style>