<?php
if (!defined('ABSPATH')) exit;

if (!current_user_can('manage_options')) return;

$services = StoneFlow_DB::get_all_services();
?>

<div class="wrap">
    <h1>📦 Service Queue</h1>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Client</th>
                <th>Service</th>
                <th>Status</th>
                <th>Priority</th>
                <th>File</th>
                <th>Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($services): ?>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo esc_html($service->client_name); ?></td>
                        <td><?php echo esc_html($service->service_name); ?></td>
                        <td><?php echo esc_html(ucwords($service->status)); ?></td>
                        <td><?php echo $service->priority ? '🔥 High' : 'Normal'; ?></td>
                        <td>
                            <?php if ($service->file_url): ?>
                                <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($service->created_at); ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=stoneflow_edit_service&id=' . $service->id); ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">No active services found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
