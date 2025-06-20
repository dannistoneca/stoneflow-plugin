<?php
defined('ABSPATH') || exit;

global $wpdb;
$table = $wpdb->prefix . 'stoneflow_services';

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
$order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $order_id));

if (!$order) {
    echo '<div class="notice notice-error"><p>Order not found.</p></div>';
    return;
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stoneflow_update_order'])) {
    $status = sanitize_text_field($_POST['status']);
    $priority = isset($_POST['priority']) ? 1 : 0;
    $file_url = esc_url_raw($_POST['file_url']);

    $wpdb->update(
        $table,
        [
            'status' => $status,
            'priority' => $priority,
            'file_url' => $file_url
        ],
        ['id' => $order_id]
    );

    echo '<div class="notice notice-success"><p>Order updated successfully.</p></div>';
    $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $order_id));
}
?>

<div class="wrap">
    <h1>Edit Service Order</h1>
    <form method="post">
        <table class="form-table">
            <tr>
                <th scope="row"><label for="status">Status</label></th>
                <td>
                    <select name="status" id="status">
                        <option value="queued" <?php selected($order->status, 'queued'); ?>>Queued</option>
                        <option value="in process" <?php selected($order->status, 'in process'); ?>>In Process</option>
                        <option value="completed" <?php selected($order->status, 'completed'); ?>>Completed</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="priority">Priority</label></th>
                <td><input type="checkbox" name="priority" id="priority" value="1" <?php checked($order->priority, 1); ?> /></td>
            </tr>
            <tr>
                <th scope="row"><label for="file_url">File URL</label></th>
                <td><input type="text" name="file_url" id="file_url" value="<?php echo esc_attr($order->file_url); ?>" class="regular-text" /></td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" name="stoneflow_update_order" id="submit" class="button button-primary" value="Update Order">
        </p>
    </form>
</div>
