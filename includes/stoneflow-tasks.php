<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles task and service delivery logic
 */

// Add new service task
function stoneflow_add_service_task( $client_id, $service_name, $priority = 0, $file_url = '' ) {
	global $wpdb;
	$table = $wpdb->prefix . 'stoneflow_services';

	$wpdb->insert(
		$table,
		array(
			'client_id'    => $client_id,
			'service_name' => sanitize_text_field( $service_name ),
			'status'       => 'Queued',
			'priority'     => (int) $priority,
			'file_url'     => esc_url_raw( $file_url ),
			'created_at'   => current_time( 'mysql', 1 ),
		)
	);
}

// Update service status
function stoneflow_update_service_status( $task_id, $new_status ) {
	global $wpdb;
	$table = $wpdb->prefix . 'stoneflow_services';

	$wpdb->update(
		$table,
		array( 'status' => sanitize_text_field( $new_status ) ),
		array( 'id' => (int) $task_id )
	);

	// Get client ID and service name to notify
	$task = $wpdb->get_row( "SELECT client_id, service_name FROM $table WHERE id = " . (int) $task_id );
	if ( $task ) {
		stoneflow_notify_status_update( $task->client_id, $task->service_name, $new_status );
	}
}

// Mark service task as priority
function stoneflow_mark_priority( $task_id, $is_priority = true ) {
	global $wpdb;
	$table = $wpdb->prefix . 'stoneflow_services';

	$wpdb->update(
		$table,
		array( 'priority' => $is_priority ? 1 : 0 ),
		array( 'id' => (int) $task_id )
	);
}

// Assign file to service task
function stoneflow_assign_file_to_task( $task_id, $file_url ) {
	global $wpdb;
	$table = $wpdb->prefix . 'stoneflow_services';

	$wpdb->update(
		$table,
		array( 'file_url' => esc_url_raw( $file_url ) ),
		array( 'id' => (int) $task_id )
	);
}
