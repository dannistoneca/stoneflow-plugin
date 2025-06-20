<?php
if (!defined('ABSPATH')) {
    exit;
}

$client_id = get_current_user_id();
$orders = $wpdb->get_results($wpdb->prepare("
    SELECT * FROM {$wpdb->prefix}stoneflow_services
    WHERE client_id = %d
    ORDER BY created_at DESC
", $client_id));
?>

<div class="stoneflow-client-orders">
    <h3>Your Service Orders</h3>

    <?php if ($orders): ?>
        <table class="stoneflow-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Date Ordered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo esc_html($order->service_name); ?></td>
                        <td><?php echo esc_html($order->status); ?></td>
                        <td><?php echo esc_html($order->priority ? 'Yes' : 'No'); ?></td>
                        <td><?php echo date('Y-m-d', strtotime($order->created_at)); ?></td>
                        <td><a href="?stoneflow_order_id=<?php echo intval($order->id); ?>" class="stoneflow-btn">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You haven’t placed any orders yet.</p>
    <?php endif; ?>
</div>
