<?php
// includes/pages/stoneflow-service-queue.php

function stoneflow_render_service_queue_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	global $wpdb;
	$table_name = $wpdb->prefix . 'stoneflow_services';

	$services = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY FIELD(status, 'queued', 'in process', 'completed'), priority DESC, created_at ASC" );

	echo '<div class="wrap"><h1>Service Queue</h1>';

	if ( $services ) {
		echo '<table class="widefat fixed striped">';
		echo '<thead><tr>
            <th>Client ID</th>
            <th>Service</th>
            <th>Status</th>
            <th>Priority</th>
            <th>File</th>
            <th>Actions</th>
        </tr></thead><tbody>';

		foreach ( $services as $service ) {
			echo '<tr>';
			echo '<td>' . esc_html( $service->client_id ) . '</td>';
			echo '<td>' . esc_html( $service->service_name ) . '</td>';
			echo '<td>' . esc_html( $service->status ) . '</td>';
			echo '<td>' . ( $service->priority ? 'High' : 'Normal' ) . '</td>';
			echo '<td>' . ( $service->file_url ? '<a href="' . esc_url( $service->file_url ) . '" target="_blank">Download</a>' : '—' ) . '</td>';
			echo '<td><a href="' . admin_url( 'admin.php?page=stoneflow-update-service&id=' . $service->id ) . '">Update</a></td>';
			echo '</tr>';
		}

		echo '</tbody></table>';
	} else {
		echo '<p>No services in queue.</p>';
	}

	echo '</div>';
}
