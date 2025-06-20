<?php
// Helper function to get client list
function stoneflow_get_all_clients() {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_clients';
    return $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
}

// Helper to get client orders
function stoneflow_get_client_orders($client_id) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_orders';
    return $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $table WHERE client_id = %d", $client_id),
        ARRAY_A
    );
}

// Helper to get order by ID
function stoneflow_get_order($order_id) {
    global $wpdb;
    $table = $wpdb->prefix . 'stoneflow_orders';
    return $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM $table WHERE id = %d", $order_id),
        ARRAY_A
    );
}

// Helper to check if user is admin
function stoneflow_is_admin_user() {
    return current_user_can('manage_options');
}

// Sanitize and save data
function stoneflow_sanitize_text($text) {
    return sanitize_text_field($text);
}
