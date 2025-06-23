<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Displays a list of services for a given client.
 */
function stoneflow_display_client_services( $client_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'stoneflow_services';

	$services = $wpdb->get_results(
		$wpdb->prepare( "SELECT * FROM $table_name WHERE client_id = %d ORDER BY created_at DESC", $client_id )
	);

	if ( empty( $services ) ) {
		echo '<p>No services found.</p>';
		return;
	}

	echo '<table class="widefat striped">';
	echo '<thead><tr>
            <th>Service</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Date</th>
            <th>Download</th>
        </tr></thead>';
	echo '<tbody>';

	foreach ( $services as $service ) {
		echo '<tr>';
		echo '<td>' . esc_html( $service->service_name ) . '</td>';
		echo '<td>' . esc_html( ucfirst( $service->status ) ) . '</td>';
		echo '<td>' . ( $service->priority ? 'Yes' : 'No' ) . '</td>';
		echo '<td>' . esc_html( date( 'Y-m-d', strtotime( $service->created_at ) ) ) . '</td>';

		if ( ! empty( $service->file_url ) ) {
			echo '<td><a href="' . esc_url( $service->file_url ) . '" target="_blank">Download</a></td>';
		} else {
			echo '<td>—</td>';
		}

		echo '</tr>';
	}

	echo '</tbody>';
	echo '</table>';
}
