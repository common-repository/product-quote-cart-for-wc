<?php
/**
 * Plugin Name: Product Quote Cart For WooCommerce
 * Description: Customer Can be ask quote of product via popup
 * Version:     1.0
 * Author:      Gravity Master
 * License:     GPLv2 or later
 * Text Domain: gmpqcw
 */

/* Stop immediately if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/* All constants should be defined in this file. */
if ( ! defined( 'GMPQCW_PREFIX' ) ) {
	define( 'GMPQCW_PREFIX', 'gmpqcw' );
}
if ( ! defined( 'GMPQCW_PLUGIN_DIR' ) ) {
	define( 'GMPQCW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'GMPQCW_PLUGIN_BASENAME' ) ) {
	define( 'GMPQCW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'GMPQCW_PLUGIN_URL' ) ) {
	define( 'GMPQCW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/* Auto-load all the necessary classes. */
if( ! function_exists( 'gmpqcw_class_auto_loader' ) ) {
	
	function gmpqcw_class_auto_loader( $class ) {
		
		$includes = GMPQCW_PLUGIN_DIR . 'includes/' . $class . '.php';
		
		if( is_file( $includes ) && ! class_exists( $class ) ) {
			include_once( $includes );
			return;
		}
		
	}
}
spl_autoload_register('gmpqcw_class_auto_loader');

/* Initialize all modules now. */
new GMPQCW_Cron();
new GMPQCW_Shortcode();
new GMPQCW_Comman();
new GMPQCW_Admin();
new GMPQCW_Frontend();

?>