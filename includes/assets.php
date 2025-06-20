<?php
// Enqueue admin scripts and styles
function stoneflow_enqueue_admin_assets($hook) {
    if (strpos($hook, 'stoneflow') === false) {
        return;
    }

    wp_enqueue_style('stoneflow-admin-css', plugin_dir_url(__FILE__) . '../assets/css/admin.css');
    wp_enqueue_script('stoneflow-admin-js', plugin_dir_url(__FILE__) . '../assets/js/admin.js', array('jquery'), false, true);
}
add_action('admin_enqueue_scripts', 'stoneflow_enqueue_admin_assets');
