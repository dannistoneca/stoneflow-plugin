<?php
defined('ABSPATH') || exit;

global $wpdb;

$service_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$table_name = $wpdb->prefix . 'stoneflow_services';

$service = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $service_id));

if (!$service) {
    echo '<div class="notice notice-error"><p>Service not found.</p></div>';
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = sanitize_text_field($_POST['status']);
    $priority = isset($_POST['priority']) ? 1 : 0;
    $file_url = esc_url_raw($_POST['file_url']);
    $notes = sanitize_textarea_field($_POST['notes']);

    $wpdb->update(
        $table_name,
        [
            'status' => $status,
            'priority' => $priority,
            'file_url' => $file_url,
            'notes' => $notes,
        ],
        ['id' => $service_id],
        ['%s', '%d', '%s', '%s']
    );

    echo '<div class="notice notice-success"><p>Service updated successfully.</p></div>';

    // Refresh data
    $service = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $service_id));
}
?>

<div class="wrap">
    <h1>🛠️ Edit Service</h1>

    <form method="post">
        <table class="form-table">
            <tr>
                <th scope="row">Client Email</th>
                <td><?php echo esc_html($service->client_email); ?></td>
            </tr>
            <tr>
                <th scope="row">Service Name</th>
                <td><?php echo esc_html($service->service_name); ?></td>
            </tr>
            <tr>
                <th scope="row"><label for="status">Status</label></th>
                <td>
                    <select name="status" id="status">
                        <option value="queued" <?php selected($service->status, 'queued'); ?>>Queued</option>
                        <option value="in process" <?php selected($service->status, 'in process'); ?>>In Process</option>
                        <option value="completed" <?php selected($service->status, 'completed'); ?>>Completed</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="priority">Priority</label></th>
                <td><input type="checkbox" name="priority" id="priority" value="1" <?php checked($service->priority, 1); ?>></td>
            </tr>
            <tr>
                <th scope="row"><label for="file_url">File URL</label></th>
                <td><input type="url" name="file_url" id="file_url" class="regular-text" value="<?php echo esc_url($service->file_url); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="notes">Notes</label></th>
                <td><textarea name="notes" id="notes" rows="5" class="large-text"><?php echo esc_textarea($service->notes); ?></textarea></td>
            </tr>
        </table>
        <p class="submit"><button type="submit" class="button-primary">Update Service</button></p>
    </form>
</div>
