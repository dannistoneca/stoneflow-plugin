<div class="wrap">
    <h1>Your Dashboard</h1>
    <p>Welcome to your StoneFlow dashboard. Here you can view your service orders, check status updates, download completed files, and leave notes for our team.</p>

    <?php
    if (!is_user_logged_in()) {
        echo '<p>Please log in to view your dashboard.</p>';
        return;
    }

    $user_id = get_current_user_id();
    global $wpdb;
    $services_table = $wpdb->prefix . 'stoneflow_services';

    $services = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $services_table WHERE client_id = %d ORDER BY created_at DESC",
        $user_id
    ));
    ?>

    <?php if ($services): ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo esc_html($service->service_name); ?></td>
                        <td><?php echo esc_html(ucfirst(str_replace('_', ' ', $service->status))); ?></td>
                        <td><?php echo $service->priority ? '🔥 High' : 'Normal'; ?></td>
                        <td><?php echo esc_html(date('M d, Y', strtotime($service->created_at))); ?></td>
                        <td><a href="?stoneflow_view_service=<?php echo intval($service->id); ?>" class="button">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No service orders found. If you’ve recently purchased a service, it may take a few minutes to appear here.</p>
    <?php endif; ?>
</div>
