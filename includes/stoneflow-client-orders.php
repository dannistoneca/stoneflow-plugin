<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Displays a table of client orders (services) from the StoneFlow plugin.
 */
function stoneflow_render_client_orders_page() {
	if ( ! is_user_logged_in() ) {
		echo '<p>You must be logged in to view your orders.</p>';
		return;
	}

	$current_user_id = get_current_user_id();

	global $wpdb;
	$table_name = $wpdb->prefix . 'stoneflow_services';

	$services = $wpdb->get_results(
		$wpdb->prepare( "SELECT * FROM $table_name WHERE client_id = %d ORDER BY created_at DESC", $current_user_id )
	);

	echo '<div class="wrap"><h2>Your Orders</h2>';

	if ( empty( $services ) ) {
		echo '<p>No orders found.</p>';
		echo '</div>';
		return;
	}

	echo '<table class="widefat striped">';
	echo '<thead><tr>
            <th>Service</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Date</th>
            <th>View</th>
        </tr></thead>';
	echo '<tbody>';

	foreach ( $services as $service ) {
		$view_url = esc_url( add_query_arg( array( 'stoneflow_order' => $service->id ), site_url( '/client-dashboard' ) ) );
		echo '<tr>';
		echo '<td>' . esc_html( $service->service_name ) . '</td>';
		echo '<td>' . esc_html( ucfirst( $service->status ) ) . '</td>';
		echo '<td>' . ( $service->priority ? 'Yes' : 'No' ) . '</td>';
		echo '<td>' . esc_html( date( 'Y-m-d', strtotime( $service->created_at ) ) ) . '</td>';
		echo '<td><a href="' . $view_url . '">View</a></td>';
		echo '</tr>';
	}

	echo '</tbody>';
	echo '</table></div>';
}
