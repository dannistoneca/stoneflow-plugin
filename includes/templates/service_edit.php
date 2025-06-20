<?php
if (!defined('ABSPATH')) exit;

if (!current_user_can('manage_options')) return;

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$service = StoneFlow_DB::get_service_by_id($id);

if (!$service) {
    echo "<div class='notice notice-error'><p>Service not found.</p></div>";
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer('stoneflow_edit_service')) {
    $status = sanitize_text_field($_POST['status']);
    $priority = isset($_POST['priority']) ? 1 : 0;
    $file_url = esc_url_raw($_POST['file_url']);
    StoneFlow_DB::update_service($id, $status, $priority, $file_url);
    echo "<div class='notice notice-success'><p>Service updated.</p></div>";
    $service = StoneFlow_DB::get_service_by_id($id); // Refresh data
}
?>

<div class="wrap">
    <h1>✏️ Edit Service</h1>
    <form method="post">
        <?php wp_nonce_field('stoneflow_edit_service'); ?>
        <table class="form-table">
            <tr>
                <th scope="row">Client</th>
                <td><?php echo esc_html($service->client_name); ?></td>
            </tr>
            <tr>
                <th scope="row">Service</th>
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
                <th scope="row">Priority</th>
                <td><input type="checkbox" name="priority" <?php checked($service->priority, 1); ?>></td>
            </tr>
            <tr>
                <th scope="row"><label for="file_url">File URL</label></th>
                <td><input type="url" name="file_url" id="file_url" value="<?php echo esc_url($service->file_url); ?>" class="regular-text"></td>
            </tr>
        </table>
        <?php submit_button('Save Changes'); ?>
    </form>
</div>
