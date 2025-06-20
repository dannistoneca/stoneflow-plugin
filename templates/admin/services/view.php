<?php
defined('ABSPATH') || exit;

global $wpdb;

$service_id = isset($_GET['service_id']) ? intval($_GET['service_id']) : 0;
$service = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}stoneflow_services WHERE id = %d", $service_id));

if (!$service) {
    echo '<div class="notice notice-error"><p>Service not found.</p></div>';
    return;
}

$user = get_userdata($service->client_id);
?>

<div class="wrap">
    <h1>📝 View Service</h1>
    <table class="form-table">
        <tr>
            <th>Client</th>
            <td><?php echo $user ? esc_html($user->display_name) : 'Unknown'; ?></td>
        </tr>
        <tr>
            <th>Service</th>
            <td><?php echo esc_html($service->service_name); ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php echo esc_html($service->status); ?></td>
        </tr>
        <tr>
            <th>Priority</th>
            <td><?php echo $service->priority ? 'Yes' : 'No'; ?></td>
        </tr>
        <tr>
            <th>File</th>
            <td>
                <?php if ($service->file_url): ?>
                    <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a>
                <?php else: ?>
                    —
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Updated</th>
            <td><?php echo esc_html($service->updated_at); ?></td>
        </tr>
    </table>
</div>
