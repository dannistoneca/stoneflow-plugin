<?php
if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$service_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$current_user_id = get_current_user_id();
$services_table = $wpdb->prefix . 'stoneflow_services';

$service = $wpdb->get_row(
    $wpdb->prepare("SELECT * FROM $services_table WHERE id = %d AND client_id = %d", $service_id, $current_user_id),
    ARRAY_A
);

if (!$service) {
    echo '<div class="wrap"><h2>Service Not Found</h2><p>Sorry, we couldn’t find that service or you don’t have permission to view it.</p></div>';
    return;
}
?>

<div class="wrap">
    <h1>Service Details</h1>
    <table class="form-table">
        <tr>
            <th>Service Name:</th>
            <td><?php echo esc_html($service['service_name']); ?></td>
        </tr>
        <tr>
            <th>Status:</th>
            <td><?php echo esc_html(ucfirst($service['status'])); ?></td>
        </tr>
        <tr>
            <th>Priority:</th>
            <td><?php echo $service['priority'] ? 'Yes' : 'No'; ?></td>
        </tr>
        <tr>
            <th>File:</th>
            <td>
                <?php if (!empty($service['file_url'])) : ?>
                    <a href="<?php echo esc_url($service['file_url']); ?>" download>Download</a>
                <?php else : ?>
                    <em>No file uploaded yet.</em>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Notes:</th>
            <td><?php echo nl2br(esc_html($service['notes'])); ?></td>
        </tr>
        <tr>
            <th>Last Updated:</th>
            <td><?php echo esc_html($service['updated_at']); ?></td>
        </tr>
    </table>

    <p><a href="?page=stoneflow_services">← Back to Services</a></p>
</div>
