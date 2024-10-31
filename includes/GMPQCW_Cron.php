<?php

class GMPQCW_Cron {
	
	public function __construct () {

		add_action( 'init', array( $this, 'GMPQCW_default' ) );
		
	}

	public function gmpqcw_default(){
		$defalarr = array(
			'gmpqcw_button_label' => 'ENQUIRY!',
			'gmpqcw_form_title' => 'Product Enquiry',
			'gmpqcw_form_required' => 'Please Enter',
			'gmpqcw_display' => 'all',
			'gmpqcw_sp_bl' => 'after_add_cart',
			'gmpqcw_label_show' => 'show_label',
			'gmpqcw_email_sub' => 'Get Quote',
			'gmpqcw_customer_email_subject' => 'Get Quote Customer',
			'gmpqcw_cart_button_label' => 'ADD TO ENQUIRY CART!',
			'gmpqcw_cart_display' => 'all',

			'gmpqcw_usershow' => 'all',
			'gmpqcw_email_body' => '<table><tr><th>Name</th><td>[name]</td></tr>
<tr><th>Email</th><td>[email]</td></tr>
<tr><th>Subject</th><td>[subject]</td></tr>
<tr><th>Mobile</th><td>[mobile]</td></tr>
<tr><th>Enquiry</th><td>[enquiry]</td></tr>
<tr><th>Product</th><td>[product]</td></tr></table>',
			'gmpqcw_email_sucesemsg' => 'Your Message Successfully Sent!',
			'gmpqcw_include_exclude' => 'all',
			
		);
		
		foreach ($defalarr as $keya => $valuea) {
			if (get_option( $keya )=='') {
				update_option( $keya, $valuea );
			}
			
		}

		$arrin = array(
			'gmpqcw_field_customizer_field' => array(
					'name' => 'Name',
					'email' => 'Email',
					'subject' => 'Subject',
					'mobile' => 'Mobile Number',
					'enquiry' => 'Enquiry',
					/*'captcha' => 'Captcha',*/
				),
			'gmpqcw_field_customizer_enble' => array(
					'name' => 'yes',
					'email' => 'yes',
					'subject' => 'yes',
					'mobile' => 'yes',
					'enquiry' => 'yes',
					/*'captcha' => 'yes',*/
				),
			'gmpqcw_field_customizer_required' => array(
					'name' => 'yes',
					'email' => 'yes',
					'subject' => 'yes',
					'mobile' => 'yes',
					'enquiry' => 'yes',
					/*'captcha' => 'yes',*/
				),
			'gmpqcw_field_customizer_type' => array(
					'name' => 'text',
					'email' => 'email',
					'subject' => 'text',
					'mobile' => 'text',
					'enquiry' => 'textarea',
					/*'captcha' => 'captcha',*/
				),
			'gmpqcw_field_customizer_order' => array(
					'name' => '1',
					'email' => '2',
					'subject' => '3',
					'mobile' => '4',
					'enquiry' => '5',
					/*'captcha' => '6',*/
				),
			
		);
		foreach ($arrin as $keya => $valuea) {
			if (get_option( $keya )=='') {
				update_option( $keya, $valuea );
			}
			
		}
		
	}
}

?>