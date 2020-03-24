<?php
/*
Plugin Name: CSD Functions - External Link
Version: 1.0
Description: Display pop-up message when leaving district websites.
Author: Josh Armentano
Author URI: https://abidewebdesign.com
Plugin URI: https://abidewebdesign.com
*/
require WP_CONTENT_DIR . '/plugins/plugin-update-checker-master/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/AbideWebDesign/csd-functions-external-link',
	__FILE__,
	'csd-functions-external-links'
);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function external_link_enqueue_script() {
	
	$plugin = get_plugin_data( __FILE__, false, false );
	
	wp_enqueue_script( 'external-link.js', plugin_dir_url( __FILE__ ) . '/assets/js/csd-external-link-min.js', '', '', true );
	
}

add_action( 'wp_enqueue_scripts', 'external_link_enqueue_script' );

?>