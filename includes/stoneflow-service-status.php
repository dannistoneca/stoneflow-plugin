<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handles service status tracking for each client order.
 */

// Update the status of a service
function stoneflow_update_service_status($service_id, $new_status) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_services';

    $wpdb->update(
        $table,
        ['status' => sanitize_text_field($new_status)],
        ['id' => intval($service_id)]
    );
}

// Mark service as priority
function stoneflow_mark_service_priority($service_id, $is_priority = true) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_services';

    $wpdb->update(
        $table,
        ['priority' => $is_priority ? 1 : 0],
        ['id' => intval($service_id)]
    );
}

// Retrieve all services for a given client
function stoneflow_get_client_services($client_id) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_services';

    return $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $table WHERE client_id = %d ORDER BY created_at DESC", $client_id)
    );
}

// Retrieve single service info
function stoneflow_get_service_by_id($service_id) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_services';

    return $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM $table WHERE id = %d", $service_id)
    );
}
