<?php
// includes/helpers/stoneflow-client-data.php

function stoneflow_get_discovery_info( $user_id ) {
	return get_user_meta( $user_id, 'stoneflow_discovery_info', true );
}

function stoneflow_save_discovery_info( $user_id, $info_array ) {
	if ( ! is_array( $info_array ) ) {
		return false;
	}

	return update_user_meta( $user_id, 'stoneflow_discovery_info', $info_array );
}

function stoneflow_get_ordered_services( $user_id ) {
	global $wpdb;
	$table = $wpdb->prefix . 'stoneflow_services';

	$query = $wpdb->prepare( "SELECT * FROM $table WHERE client_id = %d ORDER BY created_at DESC", $user_id );
	return $wpdb->get_results( $query );
}

function stoneflow_get_client_notes( $user_id ) {
	return get_user_meta( $user_id, 'stoneflow_admin_notes', true );
}

function stoneflow_save_client_note( $user_id, $note ) {
	return update_user_meta( $user_id, 'stoneflow_admin_notes', sanitize_textarea_field( $note ) );
}
