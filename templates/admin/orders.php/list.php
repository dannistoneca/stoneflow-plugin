<?php
defined('ABSPATH') || exit;

global $wpdb;
$table = $wpdb->prefix . 'stoneflow_services';
$orders = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");
?>

<div class="wrap">
    <h1>All Service Orders</h1>

    <table class="widefat fixed striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client ID</th>
                <th>Service Name</th>
                <th>Status</th>
                <th>Priority</th>
                <th>File URL</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($orders): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo esc_html($order->id); ?></td>
                        <td><?php echo esc_html($order->client_id); ?></td>
                        <td><?php echo esc_html($order->service_name); ?></td>
                        <td><?php echo esc_html($order->status); ?></td>
                        <td><?php echo $order->priority ? 'Yes' : 'No'; ?></td>
                        <td>
                            <?php if (!empty($order->file_url)): ?>
                                <a href="<?php echo esc_url($order->file_url); ?>" target="_blank">Download</a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($order->created_at); ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=stoneflow_edit_order&order_id=' . $order->id); ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">No service orders found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
