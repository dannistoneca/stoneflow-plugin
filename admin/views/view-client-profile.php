<?php
// Client Profile View
if (!defined('ABSPATH')) exit;

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$user = get_userdata($user_id);

if ($user) {
    $discovery_info = get_user_meta($user_id, 'stoneflow_discovery_info', true);
    ?>
    <div class="wrap">
        <h1>👤 <?php echo esc_html($user->display_name); ?> – Profile</h1>
        <p><strong>Email:</strong> <?php echo esc_html($user->user_email); ?></p>
        <p><strong>Status:</strong> Active</p>
        <p><strong>Added:</strong> <?php echo esc_html($user->user_registered); ?></p>

        <h2>📦 Services</h2>
        <p>No services found.</p> <!-- Placeholder – will be updated with dynamic service listings -->

        <h2>📝 Admin Notes</h2>
        <p><a href="<?php echo admin_url('admin.php?page=stoneflow-notes&user_id=' . $user_id); ?>">View/Edit Notes</a></p>

        <h2>📋 Discovery Info</h2>
        <pre><?php echo esc_html($discovery_info ?: 'No data'); ?></pre>
    </div>
    <?php
} else {
    echo '<div class="notice notice-error"><p>User not found.</p></div>';
}
