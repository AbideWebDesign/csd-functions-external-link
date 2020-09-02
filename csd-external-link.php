<?php
/*
Plugin Name: CSD Functions - External Link
Version: 1.3
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
		
	if ( !is_page('select-language') ) {

		$plugin = get_plugin_data( __FILE__, false, false );
		
		wp_enqueue_script( 'external-link.js', plugin_dir_url( __FILE__ ) . 'assets/csd-external-link-min.js', '', '', true );
		
	}
	
}

add_action( 'wp_enqueue_scripts', 'external_link_enqueue_script' );


function add_modal_function() {
	
	if ( !is_page('select-language') ) {
		
		$content = 
			'<div class="modal fade" id="modalNotification" tabindex="-1" role="dialog" aria-labelledby="modalNotification" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalNotificationLable">' . __('Notice','csdschools') . '</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p class="mb-0">' . get_field('external_link_notification', 'options') . '</p>
						</div>
						<div class="modal-footer">
							<a id="externalLink" href="#" class="btn btn-primary btn-block">' . __('Proceed','csdschools') . '</a>
						</div>
					</div>
				</div>
			</div>';
			
		echo $content;
		
	}
}

add_action('wp_footer', 'add_modal_function');

if ( function_exists('acf_add_options_sub_page') ) {
	
	acf_add_options_sub_page( 'External Links' );

}
    
function external_link_acf_field_group() {

	acf_add_local_field_group( array(
		'key' => 'group_external_link',
		'title' => 'Options - External Links',
		'fields' => array(
			array(
				'key' => 'field_external_link_notification',
				'label' => 'External Link Notification',
				'name' => 'external_link_notification',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'You leaving the Corvallis School District Website.',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-external-links',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	) );
}
add_action('acf/init', 'external_link_acf_field_group');
?>