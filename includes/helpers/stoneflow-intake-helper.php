<?php
// includes/helpers/stoneflow-intake-helper.php

function stoneflow_get_client_intake_data( $client_id ) {
	global $wpdb;
	$table = $wpdb->prefix . 'stoneflow_intake';

	$data = $wpdb->get_row(
		$wpdb->prepare( "SELECT * FROM $table WHERE client_id = %d", $client_id ),
		ARRAY_A
	);

	return $data;
}

function stoneflow_save_client_intake_data( $client_id, $intake_data ) {
	global $wpdb;
	$table = $wpdb->prefix . 'stoneflow_intake';

	$existing = stoneflow_get_client_intake_data( $client_id );

	if ( $existing ) {
		$wpdb->update(
			$table,
			$intake_data,
			array( 'client_id' => $client_id )
		);
	} else {
		$wpdb->insert(
			$table,
			array_merge( array( 'client_id' => $client_id ), $intake_data )
		);
	}
}
