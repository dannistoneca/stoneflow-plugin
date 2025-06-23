<?php
// stoneflow-helpers.php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Helper: Format date
function stoneflow_format_date( $date_string ) {
	return date( 'F j, Y, g:i a', strtotime( $date_string ) );
}

// Helper: Sanitize input fields
function stoneflow_sanitize_input( $input ) {
	return htmlspecialchars( stripslashes( trim( $input ) ) );
}

// Helper: Check if user is admin
function stoneflow_is_admin_user() {
	return current_user_can( 'manage_options' );
}

// Helper: Load a template part
function stoneflow_load_template( $template_name ) {
	$path = plugin_dir_path( __FILE__ ) . '../templates/' . $template_name . '.php';
	if ( file_exists( $path ) ) {
		include $path;
	}
}
