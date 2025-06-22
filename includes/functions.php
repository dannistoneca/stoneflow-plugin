<?php
// includes/functions.php

// Enqueue admin styles
function stoneflow_enqueue_admin_styles() {
    wp_enqueue_style('stoneflow-admin-style', plugin_dir_url(__FILE__) . '../admin/style.css');
}
add_action('admin_enqueue_scripts', 'stoneflow_enqueue_admin_styles');


