<div class="stoneflow-client-panel">
	<h2>📦 Services</h2>

	<?php if ( ! empty( $services ) ) : ?>
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<th>Service</th>
					<th>Status</th>
					<th>Priority</th>
					<th>Download</th>
					<th>Notes</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $services as $service ) : ?>
					<tr>
						<td><?php echo esc_html( $service['service_name'] ); ?></td>
						<td><?php echo esc_html( ucfirst( $service['status'] ) ); ?></td>
						<td><?php echo $service['priority'] ? '⭐' : ''; ?></td>
						<td>
							<?php if ( ! empty( $service['file_url'] ) ) : ?>
								<a href="<?php echo esc_url( $service['file_url'] ); ?>" target="_blank">Download</a>
							<?php else : ?>
								—
							<?php endif; ?>
						</td>
						<td><?php echo esc_html( $service['notes'] ); ?></td>
						<td><?php echo date( 'F j, Y g:i A', strtotime( $service['updated_at'] ) ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p>No services found.</p>
	<?php endif; ?>
</div>
