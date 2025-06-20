<?php
if (!defined('ABSPATH')) {
    exit;
}

$current_user = wp_get_current_user();
?>

<div class="stoneflow-client-header">
    <h2>Welcome, <?php echo esc_html($current_user->display_name); ?> 👋</h2>
    <p>Here you can track your services, download files, and see what's in progress.</p>
</div>
