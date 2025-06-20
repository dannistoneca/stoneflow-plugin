<?php
defined('ABSPATH') || exit;

global $wpdb;

$services = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}stoneflow_services ORDER BY updated_at DESC");
?>

<div class="wrap">
    <h1>📦 All Client Services</h1>
    <?php if ($services): ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>File</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <?php $user = get_userdata($service->client_id); ?>
                    <tr>
                        <td>
                            <?php if ($user): ?>
                                <a href="<?php echo admin_url('admin.php?page=stoneflow_client_view&client_id=' . $service->client_id); ?>">
                                    <?php echo esc_html($user->display_name); ?>
                                </a>
                            <?php else: ?>
                                Unknown
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($service->service_name); ?></td>
                        <td><?php echo esc_html($service->status); ?></td>
                        <td><?php echo $service->priority ? 'Yes' : 'No'; ?></td>
                        <td>
                            <?php if ($service->file_url): ?>
                                <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($service->updated_at); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No services found.</p>
    <?php endif; ?>
</div>
