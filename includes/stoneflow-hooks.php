<?php
// stoneflow-hooks.php

add_action( 'init', 'stoneflow_register_custom_post_types' );
add_action( 'admin_menu', 'stoneflow_admin_menu' );
add_action( 'wp_ajax_stoneflow_run_command', 'stoneflow_handle_ajax_command' );

function stoneflow_register_custom_post_types() {
	// You can define custom post types here if needed later.
}

function stoneflow_admin_menu() {
	add_menu_page(
		'StoneFlow',
		'StoneFlow',
		'manage_options',
		'stoneflow',
		'stoneflow_admin_dashboard',
		'dashicons-admin-generic',
		2
	);
}


function stoneflow_handle_ajax_command() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => 'Unauthorized' ) );
		return;
	}

	$command = isset( $_POST['command'] ) ? sanitize_text_field( $_POST['command'] ) : '';
	$args    = isset( $_POST['args'] ) ? $_POST['args'] : array();

	if ( ! class_exists( 'StoneFlow_Commands' ) ) {
		include_once plugin_dir_path( __FILE__ ) . 'admin/class-stoneflow-commands.php';
	}

	$result = StoneFlow_Commands::handle_command( $command, $args );
	wp_send_json_success( $result );
}
