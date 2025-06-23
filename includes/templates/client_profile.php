<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$client_id = intval( $_GET['client_id'] ?? 0 );
$client    = StoneFlow_DB::get_client_by_id( $client_id );
$services  = StoneFlow_DB::get_services_by_client_id( $client_id );

if ( ! $client ) {
	echo '<div class="wrap"><h2>Client Not Found</h2><p>The client you are looking for does not exist.</p></div>';
	return;
}
?>

<div class="wrap">
	<h2><?php echo esc_html( $client['name'] ); ?> – Profile</h2>
	<p><strong>Email:</strong> <?php echo esc_html( $client['email'] ); ?></p>
	<p><strong>Status:</strong> <?php echo esc_html( $client['status'] ); ?></p>
	<p><strong>Added:</strong> <?php echo esc_html( $client['created_at'] ); ?></p>

	<h3>📦 Services</h3>
	<?php if ( ! empty( $services ) ) : ?>
		<table class="widefat fixed striped">
			<thead>
				<tr>
					<th>Service</th>
					<th>Status</th>
					<th>Priority</th>
					<th>Created</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $services as $s ) : ?>
					<tr>
						<td><?php echo esc_html( $s['service_name'] ); ?></td>
						<td><?php echo esc_html( $s['status'] ); ?></td>
						<td><?php echo $s['priority'] ? 'Yes' : 'No'; ?></td>
						<td><?php echo esc_html( $s['created_at'] ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p>No services found.</p>
	<?php endif; ?>

	<h3>📝 Admin Notes</h3>
	<p><?php echo nl2br( esc_html( $client['admin_notes'] ?? '' ) ); ?></p>

	<h3>🤖 Discovery Info</h3>
	<p><?php echo nl2br( esc_html( $client['discovery_info'] ?? 'No data' ) ); ?></p>
</div>
