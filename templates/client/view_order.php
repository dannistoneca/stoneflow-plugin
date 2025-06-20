<?php
defined('ABSPATH') || exit;

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if (!$order_id) {
    echo '<div class="stoneflow-error">Invalid order ID.</div>';
    return;
}

global $wpdb;
$table = $wpdb->prefix . 'stoneflow_services';
$order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $order_id));

if (!$order) {
    echo '<div class="stoneflow-error">Order not found.</div>';
    return;
}

echo '<div class="stoneflow-order-details">';
echo '<h2>Order Details</h2>';
echo '<p><strong>Service:</strong> ' . esc_html($order->service_name) . '</p>';
echo '<p><strong>Status:</strong> ' . esc_html($order->status) . '</p>';
echo '<p><strong>Priority:</strong> ' . ($order->priority ? 'Yes' : 'No') . '</p>';
echo '<p><strong>Ordered On:</strong> ' . esc_html($order->created_at) . '</p>';

if ($order->file_url) {
    echo '<p><strong>Files:</strong> <a href="' . esc_url($order->file_url) . '" target="_blank">Download</a></p>';
}

if ($order->admin_notes) {
    echo '<div><strong>Admin Notes:</strong><br>' . nl2br(esc_html($order->admin_notes)) . '</div>';
}

if ($order->client_notes) {
    echo '<div><strong>Your Notes:</strong><br>' . nl2br(esc_html($order->client_notes)) . '</div>';
}

echo '</div>';
?>
