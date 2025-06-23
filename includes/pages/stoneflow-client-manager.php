<?php
// includes/pages/stoneflow-client-manager.php

function stoneflow_client_manager_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    include plugin_dir_path(__FILE__) . '../../admin/views/view-admin-clients.php';
}
