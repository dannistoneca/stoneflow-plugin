<div class="wrap">
    <h1>Service Details</h1>

    <?php
    global $wpdb;

    $service_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $table_name = $wpdb->prefix . 'stoneflow_services';
    $service = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $service_id));

    if ($service):
    ?>
        <table class="widefat fixed" cellspacing="0">
            <tr>
                <th>Client ID</th>
                <td><?php echo esc_html($service->client_id); ?></td>
            </tr>
            <tr>
                <th>Service Name</th>
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
                <th>Created At</th>
                <td><?php echo esc_html($service->created_at); ?></td>
            </tr>
            <tr>
                <th>Last Updated</th>
                <td><?php echo esc_html($service->updated_at); ?></td>
            </tr>
            <tr>
                <th>File URL</th>
                <td>
                    <?php if ($service->file_url): ?>
                        <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a>
                    <?php else: ?>
                        No file uploaded
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <h2>Admin Notes</h2>
        <form method="post" action="">
            <textarea name="admin_notes" rows="5" cols="50"><?php echo esc_textarea($service->admin_notes); ?></textarea><br>
            <input type="submit" name="update_notes" class="button-primary" value="Update Notes">
        </form>
    <?php else: ?>
        <p>Service not found.</p>
    <?php endif; ?>
</div>
