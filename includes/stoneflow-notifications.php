<?php
// stoneflow-notifications.php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display admin notice
function stoneflow_admin_notice( $message, $type = 'success' ) {
	echo '<div class="notice notice-' . esc_attr( $type ) . ' is-dismissible">';
	echo '<p>' . esc_html( $message ) . '</p>';
	echo '</div>';
}

// Example: Show notice after plugin activation
function stoneflow_activation_notice() {
	if ( get_option( 'stoneflow_show_activation_notice' ) ) {
		stoneflow_admin_notice( 'StoneFlow plugin activated successfully!', 'success' );
		delete_option( 'stoneflow_show_activation_notice' );
	}
}
add_action( 'admin_notices', 'stoneflow_activation_notice' );
