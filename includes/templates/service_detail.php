<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$service_id = intval( $_GET['service_id'] ?? 0 );
$service    = StoneFlow_DB::get_service_by_id( $service_id );

if ( ! $service ) {
	echo '<div class="wrap"><h2>Service Not Found</h2><p>The service you are looking for does not exist.</p></div>';
	return;
}

$client = StoneFlow_DB::get_client_by_id( $service['client_id'] );
?>

<div class="wrap">
	<h2>Service Details</h2>
	<table class="form-table">
		<tr>
			<th>Service Name</th>
			<td><?php echo esc_html( $service['service_name'] ); ?></td>
		</tr>
		<tr>
			<th>Status</th>
			<td><?php echo esc_html( $service['status'] ); ?></td>
		</tr>
		<tr>
			<th>Priority</th>
			<td><?php echo $service['priority'] ? 'Yes' : 'No'; ?></td>
		</tr>
		<tr>
			<th>Created At</th>
			<td><?php echo esc_html( $service['created_at'] ); ?></td>
		</tr>
		<tr>
			<th>Client</th>
			<td><?php echo esc_html( $client['name'] ?? 'Unknown' ); ?> (<?php echo esc_html( $client['email'] ?? '' ); ?>)</td>
		</tr>
		<tr>
			<th>Download File</th>
			<td>
				<?php if ( ! empty( $service['file_url'] ) ) : ?>
					<a href="<?php echo esc_url( $service['file_url'] ); ?>" target="_blank">Download</a>
				<?php else : ?>
					No file uploaded yet.
				<?php endif; ?>
			</td>
		</tr>
	</table>
</div>
