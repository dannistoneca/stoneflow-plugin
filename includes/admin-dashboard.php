<?php
// Admin Dashboard Page
if ( ! function_exists( 'stoneflow_admin_dashboard' ) ) {
function stoneflow_admin_dashboard() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    global $wpdb;
    $clients_table  = $wpdb->prefix . 'stoneflow_clients';
    $services_table = $wpdb->prefix . 'stoneflow_services';

    $clients  = $wpdb->get_results( "SELECT * FROM $clients_table ORDER BY created_at DESC" );
    $services = $wpdb->get_results( "SELECT * FROM $services_table ORDER BY FIELD(status,'queued','in process','completed'), priority DESC, created_at ASC" );

    include plugin_dir_path( __FILE__ ) . '../views/admin/dashboard.php';
}
}
