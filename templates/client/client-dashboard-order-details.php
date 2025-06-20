<?php
if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$client_id = get_current_user_id();
$order_id = isset($_GET['stoneflow_order_id']) ? intval($_GET['stoneflow_order_id']) : 0;

$order = $wpdb->get_row($wpdb->prepare("
    SELECT * FROM {$wpdb->prefix}stoneflow_services
    WHERE id = %d AND client_id = %d
", $order_id, $client_id));

if (!$order) {
    echo '<p>Order not found or access denied.</p>';
    return;
}
?>

<div class="stoneflow-order-details">
    <h3>Order Details</h3>
    <p><strong>Service:</strong> <?php echo esc_html($order->service_name); ?></p>
    <p><strong>Status:</strong> <?php echo esc_html($order->status); ?></p>
    <p><strong>Priority:</strong> <?php echo esc_html($order->priority ? 'Yes' : 'No'); ?></p>
    <p><strong>Date Ordered:</strong> <?php echo date('Y-m-d', strtotime($order->created_at)); ?></p>

    <?php if (!empty($order->file_url)): ?>
        <p><strong>Download:</strong> <a href="<?php echo esc_url($order->file_url); ?>" target="_blank">Download File</a></p>
    <?php endif; ?>

    <h4>Admin Notes</h4>
    <p><?php echo nl2br(esc_html($order->admin_notes)); ?></p>

    <h4>Client Notes</h4>
    <form method="post">
        <textarea name="client_notes" rows="5"><?php echo esc_textarea($order->client_notes); ?></textarea>
        <input type="hidden" name="stoneflow_update_notes" value="1">
        <input type="hidden" name="order_id" value="<?php echo esc_attr($order->id); ?>">
        <button type="submit" class="stoneflow-btn">Update Notes</button>
    </form>
</div>
