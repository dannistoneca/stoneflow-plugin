<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$client_id   = intval( $_GET['client_id'] ?? 0 );
$suggestions = StoneFlow_DB::get_suggested_services( $client_id );
?>

<div class="wrap">
	<h2>Suggested Services</h2>
	<?php if ( ! empty( $suggestions ) ) : ?>
		<table class="widefat fixed striped">
			<thead>
				<tr>
					<th>Service</th>
					<th>Reason</th>
					<th>Suggested On</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $suggestions as $suggestion ) : ?>
					<tr>
						<td><?php echo esc_html( $suggestion['service_name'] ); ?></td>
						<td><?php echo esc_html( $suggestion['reason'] ); ?></td>
						<td><?php echo esc_html( date( 'Y-m-d', strtotime( $suggestion['created_at'] ) ) ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p>No suggested services found for this client.</p>
	<?php endif; ?>
</div>
