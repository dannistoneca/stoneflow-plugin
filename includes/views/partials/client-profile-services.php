<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<h3>📦 Services</h3>

<?php if ( ! empty( $services ) ) : ?>
	<table class="wp-list-table widefat fixed striped">
		<thead>
			<tr>
				<th>Service Name</th>
				<th>Status</th>
				<th>Priority</th>
				<th>Created At</th>
				<th>File</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $services as $service ) : ?>
				<tr>
					<td><?php echo esc_html( $service->service_name ); ?></td>
					<td><?php echo esc_html( $service->status ); ?></td>
					<td><?php echo esc_html( $service->priority ); ?></td>
					<td><?php echo esc_html( $service->created_at ); ?></td>
					<td>
						<?php if ( ! empty( $service->file_url ) ) : ?>
							<a href="<?php echo esc_url( $service->file_url ); ?>" target="_blank">Download</a>
						<?php else : ?>
							N/A
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else : ?>
	<p>No services found.</p>
<?php endif; ?>
