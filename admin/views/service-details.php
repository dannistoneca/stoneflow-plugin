<div class="wrap">
    <h1>Service Details</h1>

    <?php
    if (!isset($_GET['id'])) {
        echo '<p>No service ID provided.</p>';
        return;
    }

    $service_id = intval($_GET['id']);
    global $wpdb;
    $services_table = $wpdb->prefix . 'stoneflow_services';
    $service = $wpdb->get_row($wpdb->prepare("SELECT * FROM $services_table WHERE id = %d", $service_id));

    if (!$service) {
        echo '<p>Service not found.</p>';
        return;
    }

    $client_user = get_user_by('ID', $service->client_id);
    ?>

    <table class="form-table">
        <tr>
            <th scope="row">Client</th>
            <td><?php echo esc_html($client_user ? $client_user->display_name : 'Unknown'); ?></td>
        </tr>
        <tr>
            <th scope="row">Service Name</th>
            <td><?php echo esc_html($service->service_name); ?></td>
        </tr>
        <tr>
            <th scope="row">Status</th>
            <td><?php echo esc_html($service->status); ?></td>
        </tr>
        <tr>
            <th scope="row">Priority</th>
            <td><?php echo $service->priority ? 'Yes' : 'No'; ?></td>
        </tr>
        <tr>
            <th scope="row">Created At</th>
            <td><?php echo esc_html($service->created_at); ?></td>
        </tr>
        <tr>
            <th scope="row">File</th>
            <td>
                <?php if (!empty($service->file_url)): ?>
                    <a href="<?php echo esc_url($service->file_url); ?>" download>Download</a>
                <?php else: ?>
                    —
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th scope="row">Notes</th>
            <td><pre><?php echo esc_html($service->notes ?: 'No notes'); ?></pre></td>
        </tr>
    </table>

    <p><a href="<?php echo admin_url('admin.php?page=stoneflow_clients'); ?>" class="button">Back to Clients</a></p>
</div>
