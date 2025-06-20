<?php
defined('ABSPATH') || exit;

global $wpdb;

$client_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$clients_table = $wpdb->prefix . 'stoneflow_clients';
$services_table = $wpdb->prefix . 'stoneflow_services';

$client = $wpdb->get_row($wpdb->prepare("SELECT * FROM $clients_table WHERE id = %d", $client_id));

if (!$client) {
    echo '<div class="notice notice-error"><p>Client not found.</p></div>';
    return;
}

$services = $wpdb->get_results($wpdb->prepare("SELECT * FROM $services_table WHERE client_email = %s", $client->email));
?>

<div class="wrap">
    <h1>👤 Client Profile</h1>

    <h2><?php echo esc_html($client->name); ?></h2>
    <p><strong>Email:</strong> <?php echo esc_html($client->email); ?></p>
    <p><strong>Status:</strong> <?php echo esc_html($client->status); ?></p>
    <p><strong>Added:</strong> <?php echo esc_html($client->added_at); ?></p>

    <h3>📦 Services</h3>
    <?php if ($services): ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>File</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo esc_html($service->service_name); ?></td>
                        <td><?php echo esc_html($service->status); ?></td>
                        <td><?php echo $service->priority ? 'Yes' : 'No'; ?></td>
                        <td>
                            <?php if ($service->file_url): ?>
                                <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($service->notes); ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=stoneflow_edit_service&id=' . $service->id); ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No services found for this client.</p>
    <?php endif; ?>

    <h3>📝 Admin Notes</h3>
    <p>Coming soon: Admin-only internal notes system for client profiles.</p>
</div>
