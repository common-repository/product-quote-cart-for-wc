<?php

class GMPQCW_Shortcode {
	
	public function __construct () {

		add_shortcode( 'gm_woo_enquiry_cart', array( $this, 'gm_woo_enquiry_cart' ) );
		add_action( 'wp_footer', array( $this, 'gmpqcw_wp_footer' ) );
	}

	public function gm_woo_enquiry_cart () {
		ob_start();
		if(isset(WC()->session)){
		?>
		<div class="gmpqcw_cart">
			<div class="gmpqcw_cart_top">
				<table class="gmpqcw_cart_table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-remove">&nbsp;</th>
							<th class="product-image">Image</th>
							<th class="product-name">Name</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$gmpqcw_added_cart = WC()->session->get( 'gmpqcw_added_cart' );
						if(!empty($gmpqcw_added_cart)){

							foreach ($gmpqcw_added_cart as $gmpqcwkey => $gmpqcwvalue) {
								$product = wc_get_product( $gmpqcwvalue);
								$image_urlc = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()),'shop_catalog');
								$namearr[]=$product->get_name();
							?>
							<tr class="gmpqcw_cart_item">
								<td class="product-remove">
									<a href="#" class="gmpqcw_remove_op" product_id="<?php echo $product->get_id();?>" >×</a>
								</td>
								<td class="product-thumbnail">
									<a href="<?php echo get_permalink($gmpqcwvalue); ?>">
										<?php
										if($image_urlc!=''){
											?>
											<img width="100" height="100" src="<?php echo $image_urlc[0]; ?>" >
											<?php
										}else{
											?>
											<img width="100" height="100" src="<?php echo woocommerce_placeholder_img_src(); ?>" >
											<?php
										}
										
										?>
										
									</a>
								</td>
								<td class="product-name">
									<a href="<?php echo get_permalink($gmpqcwvalue); ?>"><?php echo $product->get_name();?></a>						
								</td>
							</tr>
							<?php
							}
						}
						?>

					</tbody>
				</table>
			</div>
			<div class="gmpqcw_cart_btncls">
				<a href="#" class="button gmpqcw_inq_pp" ><?php _e('Enquiry Checkout', 'gmpqcw'); ?></a>
			</div>
			
		</div>
		<?php
		}
		$output = ob_get_contents();
		ob_end_clean(); 
		return $output;
	}

	public function gmpqcw_wp_footer() {
		
		?>
		<div  class="gmpqcw_popup_op">
			<div class="gmpqcw_inner_popup_op">
				<div class="gmpqcw_inner_popup_op_mores">
					<a href="#" class="gmpqcw_close b-close"><img src="<?php echo esc_url( GMPQCW_PLUGIN_URL.'assents/img/close_btn.png' );?>" /></a>
					
					
					<h3 class="gmpqcw_popup_title"><?php echo get_option('gmpqcw_form_title'); ?></h3>
					<?php
					$this->gmpqcw_form_footer();
					?>
				</div>
			</div>
		</div>
		<style type="text/css">
			body .gmpqcw_inq_addtocart:hover, body .gmpqcw_inq:hover, body .viewcaren:hover, body .gmpqcw_submit_btn:hover{
				text-decoration: none !important;
			}
			<?php
			if(get_option('gmpqcw_enquiry_btn_bg_color')!=''){
				?>
				.gmpqcw_inq_addtocart, .gmpqcw_inq , .viewcaren, .gmpqcw_submit_btn{
					background-color:<?php echo get_option('gmpqcw_enquiry_btn_bg_color');?> !important;
				}
				<?php
			}
			if(get_option('gmpqcw_enquiry_btn_bg_hover_color')!=''){
				?>
				.gmpqcw_inq_addtocart:hover, .gmpqcw_inq:hover , .viewcaren:hover, .gmpqcw_submit_btn:hover{
					background-color:<?php echo get_option('gmpqcw_enquiry_btn_bg_hover_color');?> !important;
				}
				<?php
			}
			if(get_option('gmpqcw_enquiry_btn_text_color')!=''){
				?>
				.gmpqcw_inq_addtocart, .gmpqcw_inq, .viewcaren, .gmpqcw_submit_btn{
					color:<?php echo get_option('gmpqcw_enquiry_btn_text_color');?> !important;
				}
				<?php
			}
			if(get_option('gmpqcw_enquiry_btn_text_hover_color')!=''){
				?>
				.gmpqcw_inq_addtocart:hover, .gmpqcw_inq:hover, .viewcaren:hover, .gmpqcw_submit_btn:hover{
					color:<?php echo get_option('gmpqcw_enquiry_btn_text_hover_color');?> !important;
				}
				<?php
			}
			
			?>
		</style>
		<?php
	}

	public function gmpqcw_form_footer($product_title='',$is_tab=false){
		$gmpqcw_label_show = get_option('gmpqcw_label_show');
		$gmpqcw_field_customizer_enble = get_option( 'gmpqcw_field_customizer_enble' );
		$gmpqcw_field_customizer_required = get_option( 'gmpqcw_field_customizer_required' );
		$gmpqcw_field_customizer_field = get_option( 'gmpqcw_field_customizer_field' );
		$gmpqcw_field_customizer_type = get_option( 'gmpqcw_field_customizer_type' );
		$gmpqcw_field_customizer_order = get_option( 'gmpqcw_field_customizer_order' );
		$gmpqcw_field_customizer_option = get_option( 'gmpqcw_field_customizer_option' );
		$gmpqcw_content_beforeform = get_option( 'gmpqcw_content_beforeform' );
		$gmpqcw_content_afterform = get_option( 'gmpqcw_content_afterform' );
		//echo "<pre>";
		//print_r($gmpqcw_field_customizer_order);
		//$fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");
		asort($gmpqcw_field_customizer_order);
		//print_r($gmpqcw_field_customizer_order);
		//echo "</pre>";
		$gmpqcw_fields = array();
		foreach ($gmpqcw_field_customizer_order as $keylooparrm => $valuelooparrm) {
			if($gmpqcw_field_customizer_enble[$keylooparrm]=="yes"){
				$fieldssetup =array();
				$fieldssetup['position']="full";
				$fieldssetup['name']=$keylooparrm;
				$fieldssetup['type']=$gmpqcw_field_customizer_type[$keylooparrm];
				$fieldssetup['label']=$gmpqcw_field_customizer_field[$keylooparrm];
				$fieldssetup['required']=(isset($gmpqcw_field_customizer_required[$keylooparrm]))?$gmpqcw_field_customizer_required[$keylooparrm]:'';
				$fromtype = array("select", "radio", "multiselect", "checkbox");
         		if (in_array( $gmpqcw_field_customizer_type[$keylooparrm], $fromtype)){
         			$fieldssetup['options']=explode("\n",$gmpqcw_field_customizer_option[$keylooparrm]);
         		}
				$gmpqcw_fields[]=$fieldssetup;
			}
			
		}
		/*echo "<pre>";
		print_r($gmpqcw_fields);
		echo "</pre>";*/
		?>
		<div class="gmpqcw_toplevel">
		<?php
		if($gmpqcw_content_beforeform!=''){
			?>
			<div class="gmpqcw_beforeformcontent">
				<?php echo $gmpqcw_content_beforeform;?>
			</div>
			<?php
		}
		?>
			<form action="#" id="gmpqcw_popup_op_form" class="gmpqcw_popup_op_form" method="post" accept-charset="utf-8">
				<div class="gmpqcw_popupcontant" id="gmpqcw_popupcontant">
						<div class="gmpqcw_inner_popupcontant">
							<?php
							foreach ($gmpqcw_fields as $key_gmpqcw_fields => $value_gmpqcw_fields) {
								echo '<div class="gmpqcw_loop gmpqcw_'.$value_gmpqcw_fields['position'].'">';
								
								$isplace ='';
								$isreq = '';
								if($gmpqcw_label_show=='show_label'){
									
									echo '<label class="gmpqcw_label">'.$value_gmpqcw_fields['label'];
									if($value_gmpqcw_fields['required']=="yes"){
										echo '<span>*</span>';
									}
									echo '</label>';
								}else{
									if($value_gmpqcw_fields['required']=="yes"){
										$isreq = '*';
									}
									$isplace = $value_gmpqcw_fields['label'];
								}
								echo '<div class="gmpqcw_inner_field">';
								if (in_array($value_gmpqcw_fields['type'], array("text","email"))){
									
									echo '<input class="gmpqcw_input" placeholder="'.$isplace.' '.$isreq.'" type="'.$value_gmpqcw_fields['type'].'" name="'.$value_gmpqcw_fields['name'].'" value="">';
									
								}
								if (in_array($value_gmpqcw_fields['type'], array("captcha"))){
									/*$digit1 = mt_rand(1,20);
								    $digit2 = mt_rand(1,20);
						            $math = "$digit1 + $digit2";
						            $gmpqcw_answer = $digit1 + $digit2;
						            if(isset(WC()->session)){
						            	WC()->session->set( 'gmpqcw_answer', $gmpqcw_answer );
						            }
								   

								    echo '<div class="gmpqcw_captchadiv">';
								    echo "<label>What's <strong>".$math."</strong> = </label>";
									echo '<input class="gmpqcw_input" autocomplete="off" placeholder="'.$isplace.' '.$isreq.'" type="text" name="'.$value_gmpqcw_fields['name'].'" value="">';
									echo '</div>';*/
									
								}
								if (in_array($value_gmpqcw_fields['type'], array("textarea"))){
									echo '<textarea class="gmpqcw_input" placeholder="'.$isplace.' '.$isreq.'" name="'.$value_gmpqcw_fields['name'].'"></textarea>';
								}
								if($value_gmpqcw_fields['type']=='select'){
									echo '<select class="gmpqcw_input" name="'.$value_gmpqcw_fields['name'].'">';
									foreach ($value_gmpqcw_fields['options'] as $keyoptions => $valueoptions) {
										echo '<option>'.$valueoptions.'</option>';
									}
									echo '</select>';
								}
								if($value_gmpqcw_fields['type']=='radio'){
									foreach ($value_gmpqcw_fields['options'] as $keyoptions => $valueoptions) {
										echo '<input type="radio" name="'.$value_gmpqcw_fields['name'].'" value="'.$valueoptions.'"/>';
										echo '<label>'.$valueoptions.'</label>';
									}
								}
								if($value_gmpqcw_fields['type']=='checkbox'){
									foreach ($value_gmpqcw_fields['options'] as $keyoptions => $valueoptions) {
										echo '<input type="checkbox" name="'.$value_gmpqcw_fields['name'].'[]" value="'.$valueoptions.'"/>';
										echo '<label>'.$valueoptions.'</label>';
									}
								}
								echo '</div>';
								echo '</div>';
							}
							?>
							
							<input type="hidden" name="action" class="gmpqcw_enquiry" value="gmpqcw_enquiry" />
							<input type="hidden" name="gmpqcw_product" class="gmpqcw_product_vl" value="<?php echo $product_title; ?>" />
						</div>
					</div>
					<div class="gmpqcw_submit">
						<button type="submit" class="gmpqcw_submit_btn"><?php _e('Send!', 'gmpqcw'); ?></button>
					</div>
			</form>
			<?php
			if($gmpqcw_content_afterform!=''){
				?>
				<div class="gmpqcw_afterformcontent">
					<?php echo $gmpqcw_content_afterform;?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}

	
}

?>