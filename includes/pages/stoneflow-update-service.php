<?php
// includes/pages/stoneflow-update-service.php

function stoneflow_render_update_service_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'stoneflow_services';

    $service_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $service = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $service_id));

    if (!$service) {
        echo '<div class="wrap"><h1>Update Service</h1><p>Service not found.</p></div>';
        return;
    }

    if (isset($_POST['stoneflow_update_service'])) {
        $status = sanitize_text_field($_POST['status']);
        $priority = isset($_POST['priority']) ? 1 : 0;
        $file_url = esc_url_raw($_POST['file_url']);

        $wpdb->update(
            $table_name,
            [
                'status' => $status,
                'priority' => $priority,
                'file_url' => $file_url
            ],
            ['id' => $service_id]
        );

        echo '<div class="updated"><p>Service updated successfully.</p></div>';
        $service = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $service_id));
    }

    echo '<div class="wrap">';
    echo '<h1>Update Service</h1>';
    echo '<form method="post">';
    echo '<table class="form-table">';
    echo '<tr><th scope="row">Status</th><td>';
    echo '<select name="status">';
    echo '<option value="queued" ' . selected($service->status, 'queued', false) . '>Queued</option>';
    echo '<option value="in process" ' . selected($service->status, 'in process', false) . '>In Process</option>';
    echo '<option value="completed" ' . selected($service->status, 'completed', false) . '>Completed</option>';
    echo '</select>';
    echo '</td></tr>';

    echo '<tr><th scope="row">Priority</th><td>';
    echo '<label><input type="checkbox" name="priority" value="1" ' . checked($service->priority, 1, false) . '> High Priority</label>';
    echo '</td></tr>';

    echo '<tr><th scope="row">File URL</th><td>';
    echo '<input type="url" name="file_url" value="' . esc_attr($service->file_url) . '" class="regular-text">';
    echo '</td></tr>';

    echo '</table>';
    echo '<p class="submit"><input type="submit" name="stoneflow_update_service" class="button-primary" value="Update Service"></p>';
    echo '</form>';
    echo '</div>';
}
