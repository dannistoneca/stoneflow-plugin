<?php
if (!defined('ABSPATH')) exit;

if (!current_user_can('manage_options')) return;

$service_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$service = StoneFlow_DB::get_service($service_id);
if (!$service) {
    echo '<div class="notice notice-error"><p>Service not found.</p></div>';
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer('stoneflow_edit_service')) {
    $status = sanitize_text_field($_POST['status']);
    $priority = isset($_POST['priority']) ? 1 : 0;
    $notes = sanitize_textarea_field($_POST['admin_notes']);

    $file_url = $service->file_url;
    if (!empty($_FILES['file']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $upload = wp_handle_upload($_FILES['file'], ['test_form' => false]);
        if (!isset($upload['error'])) {
            $file_url = $upload['url'];
        }
    }

    StoneFlow_DB::update_service($service_id, [
        'status' => $status,
        'priority' => $priority,
        'file_url' => $file_url,
        'admin_notes' => $notes
    ]);

    echo '<div class="notice notice-success"><p>Service updated successfully.</p></div>';
    $service = StoneFlow_DB::get_service($service_id); // Refresh
}
?>

<div class="wrap">
    <h1>🛠 Edit Service: <?php echo esc_html($service->service_name); ?></h1>

    <form method="post" enctype="multipart/form-data">
        <?php wp_nonce_field('stoneflow_edit_service'); ?>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="status">Status</label></th>
                <td>
                    <select name="status" id="status">
                        <option value="queued" <?php selected($service->status, 'queued'); ?>>Queued</option>
                        <option value="in_process" <?php selected($service->status, 'in_process'); ?>>In Process</option>
                        <option value="completed" <?php selected($service->status, 'completed'); ?>>Completed</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">Priority</th>
                <td><label><input type="checkbox" name="priority" value="1" <?php checked($service->priority, 1); ?>> Mark as Priority</label></td>
            </tr>
            <tr>
                <th scope="row">File Upload</th>
                <td>
                    <?php if ($service->file_url): ?>
                        <p>Current File: <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a></p>
                    <?php endif; ?>
                    <input type="file" name="file">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="admin_notes">Admin Notes</label></th>
                <td><textarea name="admin_notes" id="admin_notes" rows="6" class="large-text"><?php echo esc_textarea($service->admin_notes); ?></textarea></td>
            </tr>
        </table>
        <p><button type="submit" class="button button-primary">Save Changes</button></p>
    </form>
</div>
