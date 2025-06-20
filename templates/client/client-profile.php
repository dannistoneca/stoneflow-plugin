<?php
if (!defined('ABSPATH')) {
    exit;
}

$current_user = wp_get_current_user();
?>

<div class="stoneflow-client-profile">
    <h2>Your Profile</h2>
    <ul>
        <li><strong>Name:</strong> <?php echo esc_html($current_user->display_name); ?></li>
        <li><strong>Email:</strong> <?php echo esc_html($current_user->user_email); ?></li>
        <li><strong>Username:</strong> <?php echo esc_html($current_user->user_login); ?></li>
        <li><strong>Registered:</strong> <?php echo esc_html(date("F j, Y", strtotime($current_user->user_registered))); ?></li>
    </ul>
</div>
