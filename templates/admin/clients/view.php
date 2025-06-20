<?php
defined('ABSPATH') || exit;

global $wpdb;

$client_id = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;
$user = get_user_by('ID', $client_id);

if (!$user) {
    echo '<div class="notice notice-error"><p>Client not found.</p></div>';
    return;
}

// Retrieve discovery data
$discovery_data = get_user_meta($client_id, 'stoneflow_discovery_data', true);
$discovery_data = is_array($discovery_data) ? $discovery_data : [];

// Retrieve orders
$orders = $wpdb->get_results(
    $wpdb->prepare("SELECT * FROM {$wpdb->prefix}stoneflow_services WHERE client_id = %d", $client_id)
);
?>

<div class="wrap">
    <h1><?php echo esc_html($user->display_name); ?> – Profile</h1>
    <p><strong>Email:</strong> <?php echo esc_html($user->user_email); ?></p>
    <p><strong>Status:</strong> <?php echo esc_html(get_user_meta($client_id, 'stoneflow_status', true)); ?></p>
    <p><strong>Added:</strong> <?php echo esc_html(get_userdata($client_id)->user_registered); ?></p>

    <h2>📦 Services</h2>
    <?php if ($orders): ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>File</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo esc_html($order->service_name); ?></td>
                        <td><?php echo esc_html($order->status); ?></td>
                        <td><?php echo $order->priority ? 'Yes' : 'No'; ?></td>
                        <td>
                            <?php if ($order->file_url): ?>
                                <a href="<?php echo esc_url($order->file_url); ?>" target="_blank">Download</a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($order->updated_at); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No services found.</p>
    <?php endif; ?>

    <h2>📝 Admin Notes</h2>
    <textarea style="width: 100%; height: 150px;"><?php echo esc_textarea(get_user_meta($client_id, 'stoneflow_admin_notes', true)); ?></textarea>

    <h2>📋 Discovery Info</h2>
    <?php if ($discovery_data): ?>
        <ul>
            <?php foreach ($discovery_data as $key => $value): ?>
                <li><strong><?php echo esc_html($key); ?>:</strong> <?php echo esc_html($value); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No discovery data available.</p>
    <?php endif; ?>
</div>
