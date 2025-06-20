<?php
// stoneflow-messages.php

if (!defined('ABSPATH')) exit;

// Display messages in the dashboard
function stoneflow_display_admin_message($message, $type = 'updated') {
    echo '<div class="' . esc_attr($type) . ' notice is-dismissible">';
    echo '<p>' . esc_html($message) . '</p>';
    echo '</div>';
}

// Flash message handler (stored in session)
function stoneflow_set_flash_message($message, $type = 'success') {
    if (!session_id()) if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    $_SESSION['stoneflow_flash_message'] = $message;
    $_SESSION['stoneflow_flash_type'] = $type;
}

function stoneflow_display_flash_message() {
    if (!session_id()) if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    if (!empty($_SESSION['stoneflow_flash_message'])) {
        $type = $_SESSION['stoneflow_flash_type'] ?? 'success';
        stoneflow_display_admin_message($_SESSION['stoneflow_flash_message'], $type);
        unset($_SESSION['stoneflow_flash_message']);
        unset($_SESSION['stoneflow_flash_type']);
    }
}
add_action('admin_notices', 'stoneflow_display_flash_message');
