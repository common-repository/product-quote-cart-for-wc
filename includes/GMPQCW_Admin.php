<?php

/**
 * This class is loaded on the back-end since its main job is 
 * to display the Admin to box.
 */

class GMPQCW_Admin {
	public $fieldset_arr_gm = array();
	public function __construct () {

		$this->fieldset_arr_gm = array(
			'text' => 'Text',
			'select' => 'Select',
			'radio' => 'Radio',
			'checkbox' => 'Checkbox',
			'textarea' => 'Textarea',
		);


		add_action( 'admin_init', array( $this, 'GMPQCW_register_settings' ) );
		add_action( 'admin_menu', array( $this, 'GMPQCW_admin_menu' ) );
		add_action('admin_enqueue_scripts', array( $this, 'GMPQCW_admin_script' ));
		add_action( 'init', array( $this, 'GMPQCW_init' ) );
		if ( is_admin() ) {
			return;
		}
		
	}

	public function GMPQCW_admin_script ($hook) {
		if($hook=='toplevel_page_GMPQCW'){
		wp_enqueue_style('gmpqcw_admin_css', GMPQCW_PLUGIN_URL.'assents/css/admin-style.css');
	    wp_enqueue_style( 'gmpqcw_select2_css' , GMPQCW_PLUGIN_URL.'js/select2/select2.css');
	    wp_enqueue_script('gmpqcw_select2_js', GMPQCW_PLUGIN_URL.'js/select2/select2.js');
		wp_enqueue_script( 'wp-color-picker' ); 
		wp_enqueue_script('gmpqcw_admin_js', GMPQCW_PLUGIN_URL.'js/admin-script.js');
		}
	}

	public function GMPQCW_init () {
		$args = array(
				'label'               => __( 'gmpqcw_enquiry', 'gmpqcw' ),
				'show_ui'             => false,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => false,
				'menu_position'       => 5,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				);
	
		// Registering your Custom Post Type
		register_post_type( 'gmpqcw_enquiry', $args );
	}

	public function GMPQCW_admin_menu () {

		add_menu_page('Woo Quote Cart', 'Woo Quote Cart', 'manage_options', 'GMPQCW', array( $this, 'GMPQCW_page' ));
	}

	public function GMPQCW_page() {

		
	?>
	<div>
	  
	   <h2><?php _e('Woo Quote Cart', 'gmpqcw'); ?></h2>
	    <div class="about-text">
	        <p>
				Thank you for using our plugin! If you are satisfied, please reward it a full five-star <span style="color:#ffb900">★★★★★</span> rating.                        <br>
	            <a href="#" target="_blank">Reviews</a>
	            | <a href="https://www.codesmade.com/contact-us/" target="_blank">Support</a>
	        </p>
	    </div>
	   <?php
		$navarr = array(
			'page=GMPQCW'=>'Enquiry Cart Button Settings',
			'page=GMPQCW&view=list'=>'Enquiry List',
			'page=GMPQCW&view=general'=>'General Settings',
			'page=GMPQCW&view=exclude'=>'Include/Exclude',
			'page=GMPQCW&view=form_customizer'=>'Form Customizer',
			'page=GMPQCW&view=email_customizer'=>'Email Customizer',
			'page=GMPQCW&view=translate'=>'Translate',
			
		);
		?>
		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($navarr as $keya => $valuea) {
				$pagexl = explode("=",$keya);
				if(!isset($pagexl[2])){
					$pagexl[2] = '';
				}
				if(!isset($_REQUEST['view'])){
					$_REQUEST['view'] = '';
				}
				?>
				<a href="<?php echo admin_url( 'admin.php?'.$keya);?>" class="nav-tab <?php if($pagexl[2]==$_REQUEST['view']){echo 'nav-tab-active';} ?>"><?php echo $valuea;?></a>
				<?php
			}
			?>
		</h2>
	   <?php
		
			
			if($_REQUEST['view']==''){
				include(GMPQCW_PLUGIN_DIR.'includes/GMPQCW_Enquiry_Button_Cart.php');
			}
			if($_REQUEST['view']=='list'){
				include(GMPQCW_PLUGIN_DIR.'includes/GMPQCW_list.php');
			}
			if($_REQUEST['view']=='general'){
				include(GMPQCW_PLUGIN_DIR.'includes/GMPQCW_General.php');
			}
			if($_REQUEST['view']=='exclude'){
				include(GMPQCW_PLUGIN_DIR.'includes/GMPQCW_Exclude.php');
			}
			if($_REQUEST['view']=='form_customizer'){
				include(GMPQCW_PLUGIN_DIR.'includes/GMPQCW_Form_customizer.php');
			}
			if($_REQUEST['view']=='email_customizer'){
				include(GMPQCW_PLUGIN_DIR.'includes/GMPQCW_Email_customizer.php');
			}
			if($_REQUEST['view']=='translate'){
				include(GMPQCW_PLUGIN_DIR.'includes/GMPQCW_Translate.php');
			}
		
		
		?>
	</div>
	<?php
	}

	public function GMPQCW_register_settings() {
		if(isset($_REQUEST['action'])){
			if($_REQUEST['action']=='add_new_field_gmpqcw'){
				$gmpqcw_field_customizer_enble = get_option( 'gmpqcw_field_customizer_enble' );
				$gmpqcw_field_customizer_required = get_option( 'gmpqcw_field_customizer_required' );
				$gmpqcw_field_customizer_field = get_option( 'gmpqcw_field_customizer_field' );
				$gmpqcw_field_customizer_type = get_option( 'gmpqcw_field_customizer_type' );
				$gmpqcw_field_customizer_order = get_option( 'gmpqcw_field_customizer_order' );
				$gmpqcw_field_customizer_option = get_option( 'gmpqcw_field_customizer_option' );
				if(empty($gmpqcw_field_customizer_option)){
					$gmpqcw_field_customizer_option=array();
				}
				$unid = 'field_'.uniqid();
				$gmpqcw_field_customizer_required[$unid]=$_REQUEST['field_required_gmpqcw'];
				$gmpqcw_field_customizer_field[$unid]=$_REQUEST['gmpqcw_field_customizer_field'];
				$gmpqcw_field_customizer_type[$unid]=$_REQUEST['gmpqcw_field_customizer_type'];
				$gmpqcw_field_customizer_order[$unid]=$_REQUEST['gmpqcw_field_customizer_order'];
				$gmpqcw_field_customizer_enble[$unid]='yes';

				update_option( 'gmpqcw_field_customizer_enble', $gmpqcw_field_customizer_enble );
				update_option( 'gmpqcw_field_customizer_required', $gmpqcw_field_customizer_required );
				update_option( 'gmpqcw_field_customizer_field', $gmpqcw_field_customizer_field );
				update_option( 'gmpqcw_field_customizer_type', $gmpqcw_field_customizer_type );
				update_option( 'gmpqcw_field_customizer_order', $gmpqcw_field_customizer_order );

				
				$gmpqcw_field_customizer_option[$unid] = $_REQUEST['gmpqcw_field_customizer_option'];

				update_option( 'gmpqcw_field_customizer_option', $gmpqcw_field_customizer_option );

				wp_redirect( admin_url( 'admin.php?page=GMPQCW&view=form_customizer&msg=success') );
				exit;
			}
			if($_REQUEST['action']=='delete_keyif'){
				$gmpqcw_field_customizer_required = get_option( 'gmpqcw_field_customizer_required' );
				$gmpqcw_field_customizer_field = get_option( 'gmpqcw_field_customizer_field' );
				$gmpqcw_field_customizer_type = get_option( 'gmpqcw_field_customizer_type' );
				$gmpqcw_field_customizer_order = get_option( 'gmpqcw_field_customizer_order' );
				$gmpqcw_field_customizer_option = get_option( 'gmpqcw_field_customizer_option' );

				if(array_key_exists($_REQUEST['key'],$gmpqcw_field_customizer_required)){
					unset($gmpqcw_field_customizer_required[$_REQUEST['key']]);
				}
				if(array_key_exists($_REQUEST['key'],$gmpqcw_field_customizer_field)){
					unset($gmpqcw_field_customizer_field[$_REQUEST['key']]);
				}
				if(array_key_exists($_REQUEST['key'],$gmpqcw_field_customizer_type)){
					unset($gmpqcw_field_customizer_type[$_REQUEST['key']]);
				}
				if(array_key_exists($_REQUEST['key'],$gmpqcw_field_customizer_order)){
					unset($gmpqcw_field_customizer_order[$_REQUEST['key']]);
				}
				if(array_key_exists($_REQUEST['key'],$gmpqcw_field_customizer_option)){
					unset($gmpqcw_field_customizer_option[$_REQUEST['key']]);
				}
				

				update_option( 'gmpqcw_field_customizer_required', $gmpqcw_field_customizer_required );
				update_option( 'gmpqcw_field_customizer_field', $gmpqcw_field_customizer_field );
				update_option( 'gmpqcw_field_customizer_type', $gmpqcw_field_customizer_type );
				update_option( 'gmpqcw_field_customizer_order', $gmpqcw_field_customizer_order );
				update_option( 'gmpqcw_field_customizer_option', $gmpqcw_field_customizer_option );
				wp_redirect( admin_url( 'admin.php?page=GMPQCW&view=form_customizer&msg=success') );
				exit;
			}
		}
		
		register_setting( 'gmpqcw_cart_options_group', 'gmpqcw_cart_button_label', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_cart_options_group', 'gmpqcw_cart_display', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_cart_options_group', 'gmpqcw_cart_enable_setting', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_cart_options_group', 'gmpqcw_cart_page', array( $this, 'gmpqcw_callback' ) );

		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_usershow', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_hide_add_to_cart', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_label_show', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_show_product_outofstock', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_remove_price', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_enquiry_btn_bg_color', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_enquiry_btn_text_color', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_enquiry_btn_bg_hover_color', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_enquiry_btn_text_hover_color', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_redirect_form_sub', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_redirect_form_sub_page', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_disable_cart_checkout_page', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_general_options_group', 'gmpqcw_redirect_disable_cart_checkout_page', array( $this, 'gmpqcw_callback' ) );

		
		register_setting( 'gmpqcw_exclude_options_group', 'gmpqcw_include_exclude', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_exclude_options_group', 'gmpqcw_include_category', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_exclude_options_group', 'gmpqcw_exclude_category', array( $this, 'gmpqcw_callback' ) );


		register_setting( 'gmpqcw_form_customizer_group', 'gmpqcw_field_customizer_enble', array( $this, 'gmpqcw_enalyes' ) );
		register_setting( 'gmpqcw_form_customizer_group', 'gmpqcw_field_customizer_required', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_form_customizer_group', 'gmpqcw_field_customizer_field', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_form_customizer_group', 'gmpqcw_field_customizer_type', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_form_customizer_group', 'gmpqcw_field_customizer_order', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_form_customizer_group', 'gmpqcw_field_customizer_option', array( $this, 'gmpqcw_accesstoken_callback' ) );
		register_setting( 'gmpqcw_form_customizer_group', 'gmpqcw_content_beforeform', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_form_customizer_group', 'gmpqcw_content_afterform', array( $this, 'gmpqcw_callback' ) );

		register_setting( 'gmpqcw_email_customizer_group', 'gmpqcw_reci_email', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_email_customizer_group', 'gmpqcw_email_sub', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_email_customizer_group', 'gmpqcw_email_body', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_email_customizer_group', 'gmpqcw_email_sucesemsg', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_email_customizer_group', 'gmpqcw_send_enquiry_email_cutomer', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_email_customizer_group', 'gmpqcw_customer_email_subject', array( $this, 'gmpqcw_callback' ) );


		register_setting( 'gmpqcw_translate_options_group', 'gmpqcw_button_label', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_translate_options_group', 'gmpqcw_form_title', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_translate_options_group', 'gmpqcw_form_required', array( $this, 'gmpqcw_callback' ) );
		register_setting( 'gmpqcw_translate_options_group', 'gmpqcw_email_sucesemsg', array( $this, 'gmpqcw_callback' ) );

	}
	
	public function gmpqcw_enalyes($option) {
		/*if($option!='yes'){

		}*/
		return $option;
	} 
	public function gmpqcw_accesstoken_callback($option) {
		/*print_r($option);
		exit;
		$textToStore = htmlentities($option, ENT_QUOTES, 'UTF-8');*/
		return $option;
	}
}

?>