<?php
if (!defined('ABSPATH')) {
    exit;
}

$current_user = wp_get_current_user();
$client_id = $current_user->ID;

// Get discovery info and service list
$discovery_info = get_user_meta($client_id, 'stoneflow_discovery_info', true);
$suggested_services = get_user_meta($client_id, 'stoneflow_suggested_services', true);
$suggested_services = is_array($suggested_services) ? $suggested_services : [];

global $wpdb;
$orders = $wpdb->get_results($wpdb->prepare("
    SELECT * FROM {$wpdb->prefix}stoneflow_services
    WHERE client_id = %d
    ORDER BY created_at DESC
", $client_id));
?>

<div class="stoneflow-client-profile">
    <h2>Your Profile</h2>

    <h3>Discovery Info</h3>
    <pre><?php echo esc_html($discovery_info ? print_r($discovery_info, true) : 'No discovery info found.'); ?></pre>

    <h3>Suggested Services</h3>
    <?php if (!empty($suggested_services)): ?>
        <ul>
            <?php foreach ($suggested_services as $service): ?>
                <li><?php echo esc_html($service); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No suggestions available yet.</p>
    <?php endif; ?>

    <h3>Your Orders</h3>
    <?php if (!empty($orders)): ?>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo esc_html($order->service_name); ?></td>
                        <td><?php echo esc_html($order->status); ?></td>
                        <td><?php echo esc_html($order->created_at); ?></td>
                        <td><a href="<?php echo esc_url(add_query_arg(['stoneflow_page' => 'view-order', 'order_id' => $order->id])); ?>">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have not placed any orders yet.</p>
    <?php endif; ?>
</div>
