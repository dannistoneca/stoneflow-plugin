
<?php
defined('ABSPATH') || exit;

global $wpdb;
$table = $wpdb->prefix . 'stoneflow_services';

$orders = $wpdb->get_results("SELECT * FROM $table ORDER BY priority DESC, created_at DESC");
?>

<div class="wrap">
    <h1>Service Orders</h1>

    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Service</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Created</th>
                <th>File URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($orders): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo esc_html($order->client_id); ?></td>
                        <td><?php echo esc_html($order->service_name); ?></td>
                        <td><?php echo esc_html($order->status); ?></td>
                        <td><?php echo $order->priority ? '🔥 Yes' : 'No'; ?></td>
                        <td><?php echo esc_html($order->created_at); ?></td>
                        <td>
                            <?php if ($order->file_url): ?>
                                <a href="<?php echo esc_url($order->file_url); ?>" target="_blank">Download</a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=stoneflow_orders&action=edit&order_id=' . intval($order->id)); ?>" class="button">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">No service orders found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
