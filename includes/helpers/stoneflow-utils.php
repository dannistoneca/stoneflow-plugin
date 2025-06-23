<?php
// includes/helpers/stoneflow-utils.php

function stoneflow_get_client_services( $client_id ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'stoneflow_services';
	return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE client_id = %d", $client_id ) );
}

function stoneflow_get_all_clients() {
	$args = array(
		'role'    => 'Client',
		'orderby' => 'user_nicename',
		'order'   => 'ASC',
	);
	return get_users( $args );
}

function stoneflow_format_date( $datetime_string ) {
	$date = new DateTime( $datetime_string );
	return $date->format( 'Y-m-d H:i' );
}

function stoneflow_add_admin_notice( $message, $type = 'success' ) {
	echo '<div class="notice notice-' . esc_attr( $type ) . ' is-dismissible">';
	echo '<p>' . esc_html( $message ) . '</p>';
	echo '</div>';
}

function stoneflow_get_service_status_label( $status ) {
	$labels = array(
		'queued'     => 'Queued',
		'in_process' => 'In Process',
		'completed'  => 'Completed',
	);
	return isset( $labels[ $status ] ) ? $labels[ $status ] : ucfirst( $status );
}
