<?php

class GMPQCW_Comman {
	
	public function __construct () {

				

				add_action( 'init', array( $this, 'gmpqcw_default' ) );
                add_action('woocommerce_single_product_summary', array($this, 'gmpqcw_single'), 5);

                add_action( 'wp_ajax_gmpqcw_enquiry', array( $this, 'gmpqcw_enquiry' ));
				add_action( 'wp_ajax_nopriv_gmpqcw_enquiry', array( $this, 'gmpqcw_enquiry' ));

				add_action( 'wp_ajax_gmpqcw_add_tocart_enquiry', array( $this, 'gmpqcw_add_tocart_enquiry' ));
				add_action( 'wp_ajax_nopriv_gmpqcw_add_tocart_enquiry', array( $this, 'gmpqcw_add_tocart_enquiry' ));

				add_action( 'wp_ajax_gmpqcw_remove_cart', array( $this, 'gmpqcw_remove_cart' ));
				add_action( 'wp_ajax_nopriv_gmpqcw_remove_cart', array( $this, 'gmpqcw_remove_cart' ));

				add_action( 'woocommerce_init',  array($this, 'gmpqcw_startSession') );
    }

    public function gmpqcw_startSession(){
        if(isset(WC()->session)){
            if ( !is_admin() && !WC()->session->has_session() ) {
                WC()->session->set_customer_session_cookie( true );
            }
        }
    } 


	public function gmpqcw_default(){

		if (isset($_REQUEST['action']) && $_REQUEST['action']=='download_enquiery_data_cart') {
			if(in_array('administrator',  wp_get_current_user()->roles)){
				global $wpdb;
				$table_name = $wpdb->prefix . 'posts';
				$items = $wpdb->get_results("SELECT ID FROM $table_name where post_type='gmpqcw_enquiry' ", ARRAY_A);
				$arraml = array();
				$arramllablel=array();
				$arramllablel['id']="ID";
				$gmwqp_field_customizer_field = get_option( 'gmpqcw_field_customizer_field' );
				foreach ($gmwqp_field_customizer_field as $keymk => $valuemk) {
		             $arramllablel[$keymk]  = $valuemk;
				}
				$arramllablel['product_gmpqcw']="Products";
				$arramllablel['date_insert']="Date";
				$arraml[]=$arramllablel;
				foreach ($items as $keya => $valuea) {
					$custom_arraml= array();
					$custom_arraml['id'] =  $valuea['ID'];
					
            		foreach ($gmwqp_field_customizer_field as $keymk => $valuemk) {
		                $valuekey = get_post_meta(  $valuea['ID'], $keymk,true );
		                $custom_arraml[$keymk]  = (is_array($valuekey))?implode(",",$valuekey):$valuekey;
		            }
		            $custom_arraml['product_gmpqcw'] = get_post_meta(  $valuea['ID'], 'product_gmpqcw',true );
            		$custom_arraml['date_insert'] = get_the_date( 'd-m-Y', $valuea['ID'] );
            		$arraml[]=$custom_arraml;
				}
				/*echo "<pre>";
				print_r($arraml);
				exit;*/
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="dataall.csv"');

				$fp = fopen('php://output', 'wb');
				foreach ( $arraml as $line ) {
				    //$val = explode(",", $line);
				    fputcsv($fp, $line);
				}
				fclose($fp);
				exit;
			}
			
		}
		if (get_option( 'gmpqcw_remove_price' ) == "yes") {
			 remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		}
		if (get_option( 'gmpqcw_hide_add_to_cart' ) == "yes") {
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',30);   
   			
		}
             
		
	}

	public function gmpqcw_single(){
		if (get_option( 'gmpqcw_remove_price' ) == "yes") {
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
		}
		
	}

	public function gmpqcw_enquiry() {

		$gmpqcw_field_customizer_enble = get_option( 'gmpqcw_field_customizer_enble' );
		$gmpqcw_field_customizer_required = get_option( 'gmpqcw_field_customizer_required' );
		$gmpqcw_field_customizer_field = get_option( 'gmpqcw_field_customizer_field' );
		$gmpqcw_field_customizer_type = get_option( 'gmpqcw_field_customizer_type' );
		$gmpqcw_field_customizer_option = get_option( 'gmpqcw_field_customizer_option' );
		$gmpqcw_redirect_form_sub = get_option( 'gmpqcw_redirect_form_sub' );
		$gmpqcw_redirect_form_sub_page = get_option( 'gmpqcw_redirect_form_sub_page' );
		$gmpqcw_email_body = get_option( 'gmpqcw_email_body' );
		$gmpqcw_email_sucesemsg = get_option( 'gmpqcw_email_sucesemsg' );
		$gmpqcw_send_enquiry_email_cutomer = get_option( 'gmpqcw_send_enquiry_email_cutomer' );
		$gmpqcw_customer_email_subject = get_option( 'gmpqcw_customer_email_subject' );
		$gmpqcw_email_sub = get_option('gmpqcw_email_sub');
		$gmpqcw_customer_email_subject = get_option('gmpqcw_customer_email_subject');
		$msg = '';
		foreach ($gmpqcw_field_customizer_field as $keylooparrm => $valuelooparrm) {
			if($gmpqcw_field_customizer_enble[$keylooparrm]=="yes"){
				if(empty($_REQUEST[$keylooparrm]) && $gmpqcw_field_customizer_required[$keylooparrm]=="yes"){
					$msg .= '<li>'.__( get_option('gmpqcw_form_required').' '.$valuelooparrm.'!', 'gmpqcw' ).'</li>';
				}
				/*if($gmpqcw_field_customizer_type[$keylooparrm]=='captcha'){
					$session_val = WC()->session->get( 'gmpqcw_answer');
					if ($session_val != $_REQUEST[$keylooparrm] ){
						$msg .= '<li>'.__( 'Please Enter Correct Captcha!', 'gmpqcw' ).'</li>';
					}
				}*/
			}
		}
		

		if($msg!=''){
			$returnarr = array(
				"msg" => "error",
				"returnhtml" => "<ul class='gmpqcwmsgc gmwerr'>".$msg."</ul>"
			);
			echo json_encode($returnarr);
		}else{
			if(get_option('gmpqcw_reci_email')==''){
				$to = sanitize_text_field(get_option( 'admin_email' ));
			}else{
				$to = sanitize_text_field(get_option('gmpqcw_reci_email'));
			}
			
			$gmpqcw_added_cart = WC()->session->get( 'gmpqcw_added_cart' );
			$namearr = array();
			foreach ($gmpqcw_added_cart as $gmpqcwkey => $gmpqcwvalue) {
				$product = wc_get_product( $gmpqcwvalue);
				
				$namearr[]=$product->get_name();
			}

			$post_id = wp_insert_post(array (
										   'post_type' => 'gmpqcw_enquiry',
										   'post_title' => $_REQUEST['name'],
										   'post_status' => 'publish',
										));
			$body = $gmpqcw_email_body;
			
			foreach ($gmpqcw_field_customizer_field as $keylooparrm => $valuelooparrm) {
				if($gmpqcw_field_customizer_enble[$keylooparrm]=="yes"){
					if($gmpqcw_field_customizer_type[$keylooparrm]=='checkbox'){
						$body = str_ireplace("[".$keylooparrm."]",implode(",",$_REQUEST[$keylooparrm]),$body);
					}
					elseif($gmpqcw_field_customizer_type[$keylooparrm]!='captcha'){
						$body = str_ireplace("[".$keylooparrm."]",$_REQUEST[$keylooparrm],$body);
					}
					update_post_meta( $post_id, $keylooparrm,$_REQUEST[$keylooparrm]);
				}
			}
			
			
			

			$gmpqcw_email = $_REQUEST['email'];
			

			if($_REQUEST['gmpqcw_product']=='gmpqcw_enquiry_cart'){
				$prodnameformail= implode(", ",$namearr);
				update_post_meta( $post_id, 'product_gmpqcw', implode(", ",$namearr) );
			}else{
				$prodnameformail= sanitize_text_field($_REQUEST['gmpqcw_product']);
				update_post_meta( $post_id, 'product_gmpqcw', sanitize_text_field($_REQUEST['gmpqcw_product']) );	
			}
			$body = str_ireplace("[product]",$prodnameformail,$body);
			
			//$headers = "Reply-To: ".$gmpqcw_name." <".$gmpqcw_email.">";
	        $headers = "Content-Type: text/html; charset=UTF-8"; 
			wp_mail( $to, $gmpqcw_email_sub, $body ,$headers);
			if($gmpqcw_send_enquiry_email_cutomer=='yes' && $gmpqcw_email!=''){
				wp_mail( $gmpqcw_email, $gmpqcw_customer_email_subject, $body ,$headers);
			}
			$returnarr = array(
				"msg" => "success",
				"returnhtml" => "<ul class='gmpqcwmsgc gmwsuc'><li>".__( $gmpqcw_email_sucesemsg, 'gmpqcw' )."</li></ul>"
			);
			WC()->session->set( 'gmpqcw_added_cart', array() );
			if($gmpqcw_redirect_form_sub=='yes'){
				$returnarr['redirect']="yes";
				$returnarr['redirect_to'] = get_permalink($gmpqcw_redirect_form_sub_page);
			}else{
				$returnarr['redirect']="no";
			}
			echo json_encode($returnarr);
		}
		exit;
	}

	public function gmpqcw_remove_cart() {
		$array = WC()->session->get( 'gmpqcw_added_cart' );
		$products = array_diff($array, array($_REQUEST['product_id']));
		WC()->session->set( 'gmpqcw_added_cart', $products );
		exit;
	}

	public function gmpqcw_add_tocart_enquiry() {
		$gmpqcw_cart_page = get_option( 'gmpqcw_cart_page' );
		$add_id = $_REQUEST['add_id'];
		$gmpqcw_added_cart = WC()->session->get( 'gmpqcw_added_cart' );
		$gmpqcw_added_cart[]=$add_id; 
		$gmpqcw_added_cart=array_unique($gmpqcw_added_cart);
		WC()->session->set( 'gmpqcw_added_cart', $gmpqcw_added_cart );

		$returnarr = array(
				"msg" => "success",
				"returnhtml" => "<a href='".get_permalink($gmpqcw_cart_page)."' class='viewcaren button'>View Cart Enquiry</a>"
			);
			echo json_encode($returnarr);
		exit;
	}

}

?>