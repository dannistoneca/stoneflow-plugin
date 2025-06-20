<?php
defined('ABSPATH') || exit;

global $wpdb;
$table_name = $wpdb->prefix . 'stoneflow_services';
$results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY priority DESC, created_at ASC");

?>

<div class="wrap">
    <h1>📦 Service Queue</h1>

    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Client Email</th>
                <th>Service Name</th>
                <th>Status</th>
                <th>Priority</th>
                <th>File</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($results) : ?>
                <?php foreach ($results as $service) : ?>
                    <tr>
                        <td><?php echo esc_html($service->client_email); ?></td>
                        <td><?php echo esc_html($service->service_name); ?></td>
                        <td><?php echo esc_html($service->status); ?></td>
                        <td><?php echo esc_html($service->priority ? 'Yes' : 'No'); ?></td>
                        <td>
                            <?php if ($service->file_url) : ?>
                                <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a>
                            <?php else : ?>
                                No file
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($service->notes); ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=stoneflow_edit_service&id=' . $service->id); ?>" class="button">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="7">No services in queue.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
