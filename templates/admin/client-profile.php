<div class="wrap">
    <h1>Client Profile</h1>

    <?php
    global $wpdb;

    $client_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $users_table = $wpdb->prefix . 'users';
    $user = get_userdata($client_id);

    if ($user):
        $email = esc_html($user->user_email);
        $name = esc_html($user->display_name);
        $discovery_info = get_user_meta($client_id, 'stone_discovery_info', true);
        $discovery_info = !empty($discovery_info) ? $discovery_info : 'No data';
        $services_table = $wpdb->prefix . 'stoneflow_services';
        $services = $wpdb->get_results($wpdb->prepare("SELECT * FROM $services_table WHERE client_id = %d", $client_id));
    ?>
        <table class="widefat fixed" cellspacing="0">
            <tr>
                <th>Name</th>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>Discovery Info</th>
                <td><?php echo esc_html($discovery_info); ?></td>
            </tr>
        </table>

        <h2>Service Orders</h2>
        <?php if ($services): ?>
            <table class="widefat fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Created At</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?php echo esc_html($service->service_name); ?></td>
                            <td><?php echo esc_html($service->status); ?></td>
                            <td><?php echo $service->priority ? 'Yes' : 'No'; ?></td>
                            <td><?php echo esc_html($service->created_at); ?></td>
                            <td>
                                <?php if ($service->file_url): ?>
                                    <a href="<?php echo esc_url($service->file_url); ?>" target="_blank">Download</a>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No service orders found for this client.</p>
        <?php endif; ?>

    <?php else: ?>
        <p>Client not found.</p>
    <?php endif; ?>
</div>
