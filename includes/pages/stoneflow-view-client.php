<?php
// includes/pages/stoneflow-view-client.php

function stoneflow_render_view_client_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    global $wpdb;
    $user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $user_info = get_userdata($user_id);
    if (!$user_info) {
        echo '<div class="wrap"><h1>View Client</h1><p>User not found.</p></div>';
        return;
    }

    $client_data = stoneflow_get_client_profile($user_id);
    $notes = get_user_meta($user_id, 'stoneflow_admin_notes', true);

    $services_table = $wpdb->prefix . 'stoneflow_services';
    $services = $wpdb->get_results($wpdb->prepare("SELECT * FROM $services_table WHERE client_id = %d", $user_id));

    echo '<div class="wrap">';
    echo '<h1>Client Profile</h1>';
    echo '<p><strong>Email:</strong> ' . esc_html($user_info->user_email) . '</p>';
    echo '<p><strong>Status:</strong> ' . esc_html($user_info->user_status) . '</p>';
    echo '<p><strong>Added:</strong> ' . esc_html($user_info->user_registered) . '</p>';

    echo '<h2>Profile Details</h2>';
    echo '<table class="widefat striped" style="max-width:600px">';
    foreach ($client_data as $key => $val) {
        if ($key === 'added') { continue; }
        $label = ucwords(str_replace('_', ' ', $key));
        echo '<tr><th style="width:200px">' . esc_html($label) . '</th><td>' . esc_html($val) . '</td></tr>';
    }
    echo '</table>';

    echo '<h2>📦 Services</h2>';
    if ($services) {
        echo '<ul>';
        foreach ($services as $service) {
            echo '<li>' . esc_html($service->service_name) . ' – <strong>' . esc_html($service->status) . '</strong></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No services found.</p>';
    }

    echo '<h2>📝 Admin Notes</h2>';
    echo '<form method="post">';
    echo '<textarea name="admin_notes" rows="6" style="width: 100%;">' . esc_textarea($notes) . '</textarea>';
    echo '<p><input type="submit" class="button-primary" value="Save Notes"></p>';
    echo '</form>';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_notes'])) {
        update_user_meta($user_id, 'stoneflow_admin_notes', sanitize_textarea_field($_POST['admin_notes']));
        echo '<div class="updated"><p>Notes saved.</p></div>';
    }

    echo '</div>';
}
