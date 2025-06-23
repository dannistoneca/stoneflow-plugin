<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles the Discovery Session logic with S.T.O.N.E.
 */

// Save Discovery Info for Client
function stoneflow_save_discovery_info( $client_id, $info_array ) {
	$discovery_data = maybe_serialize( $info_array );
	update_user_meta( $client_id, 'stoneflow_discovery_info', $discovery_data );
}

// Get Discovery Info for Client
function stoneflow_get_discovery_info( $client_id ) {
	$data = get_user_meta( $client_id, 'stoneflow_discovery_info', true );
	return maybe_unserialize( $data );
}

// Display formatted Discovery Info in admin
function stoneflow_format_discovery_info( $client_id ) {
	$info = stoneflow_get_discovery_info( $client_id );

	if ( empty( $info ) ) {
		return '<em>No discovery data found.</em>';
	}

	$output = '<ul class="stoneflow-discovery-list">';
	foreach ( $info as $key => $value ) {
		$key_label = ucwords( str_replace( '_', ' ', $key ) );
		$output   .= '<li><strong>' . esc_html( $key_label ) . ':</strong> ' . esc_html( $value ) . '</li>';
	}
	$output .= '</ul>';

	return $output;
}
