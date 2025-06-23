<?php
// admin/dashboard.php

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}

global $wpdb;
$table_name = $wpdb->prefix . 'stoneflow_clients';
$clients    = $wpdb->get_results( "SELECT * FROM $table_name" );

?>
<div class="wrap">
	<h1>StoneFlow Clients</h1>
	<table class="widefat fixed striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Discovery Info</th>
			</tr>
		</thead>
		<tbody>
			<?php if ( ! empty( $clients ) ) : ?>
				<?php foreach ( $clients as $client ) : ?>
					<tr>
						<td><?php echo esc_html( $client->name ); ?></td>
						<td><?php echo esc_html( $client->email ); ?></td>
						<td><?php echo esc_html( $client->discovery_info ? $client->discovery_info : 'No data' ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr><td colspan="3">No clients found.</td></tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
