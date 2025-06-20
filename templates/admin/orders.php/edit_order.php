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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer('stoneflow_edit_order')) {
    $status = sanitize_text_field($_POST['status']);
    $priority = isset($_POST['priority']) ? 1 : 0;
    $file_url = esc_url_raw($_POST['file_url']);
    $admin_notes = sanitize_textarea_field($_POST['admin_notes']);

    $wpdb->update(
        $table,
        [
            'status' => $status,
            'priority' => $priority,
            'file_url' => $file_url,
            'admin_notes' => $admin_notes
        ],
        ['id' => $order_id]
    );

    echo '<div class="updated"><p>Order updated successfully.</p></div>';
    $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $order_id));
}

?>

<div class="wrap">
    <h1>Edit Order</h1>
    <form method="post">
        <?php wp_nonce_field('stoneflow_edit_order'); ?>
        <table class="form-table">
            <tr>
                <th><label for="status">Status</label></th>
                <td><input type="text" name="status" id="status" value="<?php echo esc_attr($order->status); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label for="priority">Priority</label></th>
                <td><input type="checkbox" name="priority" id="priority" value="1" <?php checked($order->priority); ?>></td>
            </tr>
            <tr>
                <th><label for="file_url">File URL</label></th>
                <td><input type="url" name="file_url" id="file_url" value="<?php echo esc_url($order->file_url); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label for="admin_notes">Admin Notes</label></th>
                <td><textarea name="admin_notes" id="admin_notes" rows="5" class="large-text"><?php echo esc_textarea($order->admin_notes); ?></textarea></td>
            </tr>
        </table>
        <p><input type="submit" class="button button-primary" value="Save Changes"></p>
    </form>
</div>
