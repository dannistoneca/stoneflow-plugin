<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_user = wp_get_current_user();
if ( ! $current_user->exists() ) {
	echo '<p>Please log in to view your dashboard.</p>';
	return;
}

$services = StoneFlow_DB::get_client_services( $current_user->user_email );
?>

<div class="stoneflow-client-dashboard">
	<h2>👋 Welcome, <?php echo esc_html( $current_user->display_name ); ?>!</h2>
	<p>Here’s a look at your active services and their status.</p>

	<?php if ( empty( $services ) ) : ?>
		<p>No services found yet. Once your services are assigned, they’ll appear here!</p>
	<?php else : ?>
		<table class="wp-list-table widefat striped">
			<thead>
				<tr>
					<th>Service Name</th>
					<th>Status</th>
					<th>Priority</th>
					<th>File</th>
					<th>Admin Notes</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $services as $service ) : ?>
					<tr>
						<td><?php echo esc_html( $service->service_name ); ?></td>
						<td><strong><?php echo esc_html( ucwords( str_replace( '_', ' ', $service->status ) ) ); ?></strong></td>
						<td><?php echo $service->priority ? '🔥 Yes' : 'No'; ?></td>
						<td>
							<?php if ( $service->file_url ) : ?>
								<a href="<?php echo esc_url( $service->file_url ); ?>" target="_blank">Download</a>
							<?php else : ?>
								—
							<?php endif; ?>
						</td>
						<td><?php echo esc_html( $service->admin_notes ?: '—' ); ?></td>
						<td><?php echo esc_html( date( 'Y-m-d', strtotime( $service->updated_at ) ) ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</div>
