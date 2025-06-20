<?php
// client-dashboard.php
$current_user = wp_get_current_user();
$client_email = $current_user->user_email;
$client_id = $current_user->ID;

global $wpdb;
$table_name = $wpdb->prefix . 'stoneflow_services';

$services = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE client_id = %d", $client_id));

?>

<div class="stoneflow-dashboard">
    <h2>Welcome, <?php echo esc_html($current_user->display_name); ?>!</h2>
    <p>This is your personal service dashboard. Track your services and download files here.</p>

    <?php if ($services): ?>
        <table class="stoneflow-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo esc_html($service->service_name); ?></td>
                        <td><?php echo esc_html(ucfirst($service->status)); ?></td>
                        <td><?php echo esc_html($service->priority); ?></td>
                        <td>
                            <?php if (!empty($service->file_url)): ?>
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
        <p>You currently have no services assigned. Please check back soon or contact support.</p>
    <?php endif; ?>
</div>
