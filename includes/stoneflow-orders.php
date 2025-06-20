<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handles StoneFlow order data and order views.
 */

// Save a new order to the database
function stoneflow_add_order($client_id, $service_name, $status = 'queued', $priority = 0, $file_url = '') {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_services';

    $wpdb->insert($table, [
        'client_id'     => $client_id,
        'service_name'  => sanitize_text_field($service_name),
        'status'        => sanitize_text_field($status),
        'priority'      => intval($priority),
        'file_url'      => esc_url_raw($file_url),
        'created_at'    => current_time('mysql'),
    ]);
}

// Update an order’s status
function stoneflow_update_order_status($order_id, $new_status) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_services';

    $wpdb->update(
        $table,
        ['status' => sanitize_text_field($new_status)],
        ['id' => intval($order_id)]
    );
}

// Fetch all orders for a specific client
function stoneflow_get_orders_for_client($client_id) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_services';

    return $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $table WHERE client_id = %d ORDER BY created_at DESC", $client_id)
    );
}

// Fetch all orders for admin
function stoneflow_get_all_orders() {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_services';

    return $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");
}
