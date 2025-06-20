<?php
// Admin Client Profile View
if (!defined('ABSPATH')) exit;

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$user = get_user_by('ID', $user_id);

if (!$user) {
    echo '<div class="notice notice-error"><p>User not found.</p></div>';
    return;
}

$discovery = get_user_meta($user_id, 'stoneflow_discovery_data', true);
$services = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}stoneflow_services WHERE client_id = %d", $user_id)
);
?>

<div class="wrap">
    <h1>👤 <?php echo esc_html($user->display_name); ?> – Profile</h1>
    <p><strong>Email:</strong> <?php echo esc_html($user->user_email); ?></p>
    <p><strong>Status:</strong> Active</p>
    <p><strong>Added:</strong> <?php echo esc_html($user->user_registered); ?></p>

    <hr>
    <h2>📦 Services</h2>
    <?php if (!empty($services)) : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo esc_html($service->service_name); ?></td>
                        <td><?php echo esc_html($service->status); ?></td>
                        <td><?php echo $service->priority ? '🔥 Yes' : 'No'; ?></td>
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
        <p>No services found.</p>
    <?php endif; ?>

    <hr>
    <h2>📝 Admin Notes</h2>
    <textarea rows="5" style="width: 100%;" placeholder="Coming soon…" disabled></textarea>
</div>
