<?php
defined('ABSPATH') || exit;

$client_id = get_current_user_id();
$orders = stoneflow_get_client_orders($client_id);
?>

<div class="stoneflow-client-panel">
    <h2>Your Service Orders</h2>

    <?php if (!empty($orders)) : ?>
        <table class="stoneflow-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo esc_html($order['service_name']); ?></td>
                        <td><?php echo esc_html($order['status']); ?></td>
                        <td><?php echo esc_html($order['priority']); ?></td>
                        <td>
                            <a href="<?php echo esc_url(add_query_arg(['stoneflow_action' => 'view_order', 'id' => $order['id']])); ?>" class="button">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>You don’t have any orders yet. Once you purchase a service, it will appear here with real-time updates.</p>
    <?php endif; ?>
</div>
