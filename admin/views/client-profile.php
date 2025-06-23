<div class="wrap">
	<h1>Client Profile</h1>

	<?php
	if ( ! isset( $_GET['id'] ) ) {
		echo '<p>No client ID provided.</p>';
		return;
	}

	$client_id = intval( $_GET['id'] );
	$user      = get_user_by( 'ID', $client_id );

	if ( ! $user ) {
		echo '<p>Client not found.</p>';
		return;
	}

	$client_meta        = get_user_meta( $client_id );
	$discovery_info     = get_user_meta( $client_id, 'stoneflow_discovery_info', true );
	$suggested_services = get_user_meta( $client_id, 'stoneflow_suggested_services', true );

	global $wpdb;
	$services_table  = $wpdb->prefix . 'stoneflow_services';
	$client_services = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $services_table WHERE client_id = %d", $client_id ) );
	?>

	<table class="form-table">
		<tr>
			<th scope="row">Name</th>
			<td><?php echo esc_html( $user->display_name ); ?></td>
		</tr>
		<tr>
			<th scope="row">Email</th>
			<td><?php echo esc_html( $user->user_email ); ?></td>
		</tr>
		<tr>
			<th scope="row">Discovery Info</th>
			<td><pre><?php echo esc_html( $discovery_info ?: 'No data' ); ?></pre></td>
		</tr>
		<tr>
			<th scope="row">Suggested Services</th>
			<td><pre><?php echo esc_html( $suggested_services ?: 'None' ); ?></pre></td>
		</tr>
	</table>

	<h2>Service Orders</h2>

	<?php if ( $client_services ) : ?>
		<table class="widefat fixed striped">
			<thead>
				<tr>
					<th>Service Name</th>
					<th>Status</th>
					<th>Priority</th>
					<th>Created At</th>
					<th>File</th>
					<th>View</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $client_services as $service ) : ?>
					<tr>
						<td><?php echo esc_html( $service->service_name ); ?></td>
						<td><?php echo esc_html( $service->status ); ?></td>
						<td><?php echo $service->priority ? 'Yes' : 'No'; ?></td>
						<td><?php echo esc_html( $service->created_at ); ?></td>
						<td>
							<?php if ( ! empty( $service->file_url ) ) : ?>
								<a href="<?php echo esc_url( $service->file_url ); ?>" download>Download</a>
							<?php else : ?>
								—
							<?php endif; ?>
						</td>
						<td><a href="<?php echo admin_url( 'admin.php?page=stoneflow_service_details&id=' . $service->id ); ?>" class="button">View</a></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p>No services found.</p>
	<?php endif; ?>

	<p><a href="<?php echo admin_url( 'admin.php?page=stoneflow_clients' ); ?>" class="button">Back to Clients</a></p>
</div>
