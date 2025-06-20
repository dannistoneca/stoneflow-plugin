<?php
if (!defined('ABSPATH')) {
    exit;
}

$current_user = wp_get_current_user();
global $wpdb;

$order_id = isset($_GET['view_order']) ? intval($_GET['view_order']) : 0;

$service = $wpdb->get_row($wpdb->prepare("
    SELECT * FROM {$wpdb->prefix}stoneflow_services
    WHERE id = %d AND client_id = %d
", $order_id, $current_user->ID));

if (!$service) {
    echo '<div class="wrap"><h2>Order not found</h2><p>We couldn’t find that order or you do not have permission to view it.</p></div>';
    return;
}
?>

<div class="wrap">
    <h1>Order Details: <?php echo esc_html($service->service_name); ?></h1>

    <table class="form-table">
        <tr>
            <th>Status:</th>
            <td><?php echo esc_html($service->status); ?></td>
        </tr>
        <tr>
            <th>Priority:</th>
            <td><?php echo esc_html($service->priority); ?></td>
        </tr>
        <tr>
            <th>Created At:</th>
            <td><?php echo esc_html($service->created_at); ?></td>
        </tr>
        <tr>
            <th>File:</th>
            <td>
                <?php if (!empty($service->file_url)): ?>
                    <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a>
                <?php else: ?>
                    Not yet available
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Admin Notes:</th>
            <td><?php echo nl2br(esc_html($service->admin_notes)); ?></td>
        </tr>
        <tr>
            <th>Your Notes:</th>
            <td><?php echo nl2br(esc_html($service->client_notes)); ?></td>
        </tr>
    </table>

    <p><a href="<?php echo esc_url(remove_query_arg('view_order')); ?>">&larr; Back to Dashboard</a></p>
</div>
