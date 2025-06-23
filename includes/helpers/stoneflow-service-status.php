<?php
// includes/helpers/stoneflow-service-status.php

function stoneflow_get_service_status_label( $status ) {
	$labels = array(
		'queued'     => 'Queued',
		'in_process' => 'In Process',
		'completed'  => 'Completed',
		'on_hold'    => 'On Hold',
		'cancelled'  => 'Cancelled',
	);

	return isset( $labels[ $status ] ) ? $labels[ $status ] : 'Unknown';
}

function stoneflow_get_status_badge_class( $status ) {
	$classes = array(
		'queued'     => 'badge badge-warning',
		'in_process' => 'badge badge-info',
		'completed'  => 'badge badge-success',
		'on_hold'    => 'badge badge-secondary',
		'cancelled'  => 'badge badge-danger',
	);

	return isset( $classes[ $status ] ) ? $classes[ $status ] : 'badge badge-light';
}
