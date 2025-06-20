<?php
// stoneflow-shortcodes.php

function stoneflow_display_client_dashboard() {
    ob_start();
    if (!is_user_logged_in()) {
        echo '<p>You need to log in to access your dashboard.</p>';
    } else {
        include plugin_dir_path(__FILE__) . '../templates/client-dashboard.php';
    }
    return ob_get_clean();
}

add_shortcode('stoneflow_client_dashboard', 'stoneflow_display_client_dashboard');
