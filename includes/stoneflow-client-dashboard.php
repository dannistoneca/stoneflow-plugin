<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Renders the client dashboard showing all their assigned service orders.
 */

if ( ! function_exists( 'stoneflow_render_client_dashboard' ) ) {
    function stoneflow_render_client_dashboard() {
        if ( ! is_user_logged_in() ) {
            return '<p>You must be logged in to view your dashboard.</p>';
        }

        global $wpdb;
        $user_id = get_current_user_id();
        $table   = $wpdb->prefix . 'stoneflow_services';

        $orders = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM $table WHERE client_id = %d ORDER BY created_at DESC",
                $user_id
            )
        );

        ob_start();
        include plugin_dir_path( __FILE__ ) . '../views/client/dashboard.php';
        return ob_get_clean();
    }
}

if ( ! function_exists( 'stoneflow_client_dashboard_shortcode' ) ) {
    function stoneflow_client_dashboard_shortcode() {
        return stoneflow_render_client_dashboard();
    }
    add_shortcode( 'stoneflow_client_dashboard', 'stoneflow_client_dashboard_shortcode' );
}
