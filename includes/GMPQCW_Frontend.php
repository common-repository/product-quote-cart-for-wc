<?php

/**
 * This class is loaded on the front-end since its main job is 
 * to display the Admin to box.
 */

class GMPQCW_Frontend  extends GMPQCW_Shortcode{

	public $global_include_category;
	public $global_exclude_category;

	public function __construct () {

		$this->global_include_category = get_option( 'gmpqcw_include_category' );
		$this->global_exclude_category = get_option( 'gmpqcw_exclude_category' );
		add_filter( 'init', array( $this, 'initcut' ));
		add_filter( 'wp', array( $this, 'wpcut' ));
		add_action( 'woocommerce_before_add_to_cart_quantity', array( $this, 'add_script_variation_name' ));
		
	}

	public function wpcut(){
		$gmpqcw_disable_cart_checkout_page = get_option( 'gmpqcw_disable_cart_checkout_page' );
		$gmpqcw_redirect_disable_cart_checkout_page = get_option( 'gmpqcw_redirect_disable_cart_checkout_page' );
		if($gmpqcw_disable_cart_checkout_page == 'yes'){
			if(is_cart() || is_checkout()){
				
				wp_redirect(get_permalink($gmpqcw_redirect_disable_cart_checkout_page));
				exit;
			}	
		}
		
	}

	public function initcut(){

		$gmpqcw_display = get_option( 'gmpqcw_display' );
		$gmpqcw_sp_bl = get_option( 'gmpqcw_sp_bl' );
		$gmpqcw_enable_setting = get_option( 'gmpqcw_enable_setting' );
		$gmpqcw_cart_enable_setting = get_option( 'gmpqcw_cart_enable_setting' );
		$gmpqcw_cart_display = get_option( 'gmpqcw_cart_display' );
		$gmpqcw_usershow = get_option( 'gmpqcw_usershow' );
		$showforuser = 'yes';
		if($gmpqcw_usershow=='logged_user' && !is_user_logged_in()){
			$showforuser = 'no';
		}
		if($gmpqcw_usershow=='logged_out' && is_user_logged_in()){
			$showforuser = 'no';
		}
		add_filter( 'woocommerce_after_shop_loop_item', array( $this, 'gmpqcw_addcssloop' ), 10, 3 );
		add_action( 'woocommerce_single_product_summary', array( $this, 'gmpqcw_addcsssingle' ) ,35);

		
		if($gmpqcw_cart_enable_setting=='yes' && $showforuser == 'yes'){
			if($gmpqcw_cart_display=='all'){
				add_filter( 'woocommerce_after_shop_loop_item', array( $this, 'gmpqcw_after_button_cart' ), 10, 3 );
			}
			add_action( 'woocommerce_single_product_summary', array( $this, 'gmpqcw_after_addtocart_enquiry' ) ,35);
		}
		add_action( 'wp_enqueue_scripts',  array( $this, 'gmpqcw_insta_scritps' ) );
		add_shortcode('gmpqcw_enquiry_single_product', array( $this, 'gmpqcw_enquiry_single_product_shortcode' ));
	}

	public function gmpqcw_insta_scritps () {
		wp_enqueue_style('gmpqcw-stylee', GMPQCW_PLUGIN_URL . '/assents/css/style.css', array(), '1.0.0', 'all');
		wp_enqueue_script('gmpqcw-bbpopp', GMPQCW_PLUGIN_URL . '/assents/js/jquery.bpopup.min.js', array(), '1.0.0', true );
		wp_enqueue_script('gmpqcw-script', GMPQCW_PLUGIN_URL . '/assents/js/script.js', array(), '1.0.0', true );
		wp_localize_script( 'gmpqcw-script', 'gmpqcw_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}

	function gmpqcw_enquiry_single_product_shortcode($atts){
		ob_start();
		global $post;
		if (isset($atts['id']) && $atts['id']!='') {
			$product_id = $atts['id'];
			$product = wc_get_product( $product_id );
		}else{
			$product_id = $post->ID;
			$product = wc_get_product( $product_id );
		}
		if(!empty($product)){
			if($this->gmpqcw_is_exclude($product->get_id())==true){
			return;
			}
			
			if (get_option('gmpqcw_cart_button_label')!='') {
					$gmpqcw_cart_button_label = get_option('gmpqcw_cart_button_label');
			}else{
				$gmpqcw_cart_button_label = __('Inquiry!', 'gmpqcw' );
			}
			

			?>
			<div class="gmpqcw_inquirybtn">
				<a href="#" class="button gmpqcw_inq_addtocart" add_id="<?php echo $product->get_id();?>" title="<?php echo $product->get_name(); ?>"><?php echo $gmpqcw_cart_button_label;?></a>
			</div>
			<?php
		}
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	
	public function gmpqcw_after_addtocart_enquiry() {
		global $product;
		$gmpqcw_cart_button_label = get_option('gmpqcw_cart_button_label');

		if($this->gmpqcw_is_exclude($product->get_id())==true){
			return;
		}
		
		?>
		<div class="gmpqcw_inquirybtn">
			<a href="#" class="button gmpqcw_inq_addtocart" add_id="<?php echo $product->get_id();?>" title="<?php echo $product->get_name(); ?>"><?php echo $gmpqcw_cart_button_label;?></a>
		</div>
		<?php
	}
	

	

	
	public function gmpqcw_after_button_cart(  ){
		global $product;
		if($this->gmpqcw_is_exclude($product->get_id())==true){
			return;
		}
		$gmpqcw_cart_button_label = get_option('gmpqcw_cart_button_label');
		?>
		<div class="gmpqcw_inquirytmltbtn_loop">
			<a href="#" class="button gmpqcw_inq_addtocart" add_id="<?php echo $product->get_id();?>" title="<?php echo $product->get_name(); ?>" ><?php echo $gmpqcw_cart_button_label;?></a>
		</div>
		<?php
		
	}

	
	
	public function gmpqcw_addcssloop(  ){
		global $product;
		if($this->gmpqcw_is_exclude($product->get_id())==true){
			return;
		}
		?>
		<style type="text/css">
			<?php
			if (get_option( 'gmpqcw_remove_price' ) == "yes") {
			?>
			.post-<?php echo  $product->get_id();?> .price{
				display: none !important;
			}
			<?php 
			}
			?>
		</style>
		<?php
	}
	public function gmpqcw_addcsssingle(  ){
		global $product;
		if($this->gmpqcw_is_exclude($product->get_id())==true){
			return;
		}
		?>
		<style type="text/css">
			<?php
			if (get_option( 'gmpqcw_remove_price' ) == "yes") {
			?>
			.post-<?php echo  $product->get_id();?> .price{
				display: none !important;
			}
			<?php 
			}
			?>
		</style>
		<?php
	}
	

	

	

	public function gmpqcw_is_exclude($product_id){
		$gmpqcw_include_exclude = get_option( 'gmpqcw_include_exclude' );
		$gmpqcw_show_product_outofstock = get_option( 'gmpqcw_show_product_outofstock' );
		$product = wc_get_product( $product_id );
		$isretus = false;
		$product_cats_ids = wc_get_product_term_ids( $product_id, 'product_cat' );
		if ($gmpqcw_include_exclude=='include') {
			$includeids = (empty($this->global_include_category))?array():$this->global_include_category;
			$is_include = array_intersect($includeids,$product_cats_ids);
			if(count($is_include)==0){
				$isretus = true;
			}
		}elseif($gmpqcw_include_exclude=='exlude'){
			$exludeids = (empty($this->global_exclude_category))?array():$this->global_exclude_category;
			$is_exclude = array_intersect($exludeids,$product_cats_ids);
			if(count($is_exclude)>0){
				$isretus = true;
			}
		}else{
			$isretus = false;
		}
		if($gmpqcw_show_product_outofstock=='yes'){
			if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
				//echo "ggg";
			}else{
				//echo "bb";
				$isretus = true;
			}
		}
		//echo $isretus;
		
		return $isretus;
	}

	public function add_script_variation_name() {
	   global $product;
	   if ( $product->is_type( 'variable' ) ) {
	   		/*echo "<pre>";
	   		print_r($product->get_name());
	   		echo "</pre>";*/
	   		ob_start();
	   		$separator = ' - ';
			?>
			var name = '<?php global $product; echo $product->get_name(); ?>';

	        jQuery('form.cart').on('show_variation', function(event, data) {
	            var text = '';

	            jQuery.each( data.attributes, function( key, value ) {
	                text += '<?php echo $separator; ?>' + value;
	            });
	            setInterval(function () {
	            	jQuery('.gmpqcw_product_vl').val( name + text );
	            }, 2000);
	            

	        }).on('hide_variation', function(event, data) {
	            jQuery('.gmpqcw_product_vl').val( name );
	        });
			<?php
			$output = ob_get_contents();
			ob_end_clean();
	      	wc_enqueue_js($output);
	   }
	}
}



 
